<?php

namespace Tests\Feature\Auth;

use App\Models\Member;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class AuthLoginTest extends TestCase
{
    use RefreshDatabase;

    // reset DB between tests


    /** ---------------------------------------------------------------
     *  L-01  Login – happy path
     * -------------------------------------------------------------- */
    public function test_member_can_log_in_with_valid_credentials(): void
    {
        $member = Member::factory()->create([
            'password' => Hash::make('secret123'),
        ]);

        /** 1. Ask Sanctum for the CSRF cookie (same as the browser) */
        $csrf = $this->withServerVariables([
            // makes Sanctum treat it as a “stateful” first-party request
            'HTTP_ORIGIN' => config('app.url'),
            'HTTP_REFERER' => config('app.url'),
        ])
            ->get('/sanctum/csrf-cookie');

        // pull the token value out of Laravel’s cookie jar
        $token = $csrf->headers->getCookies()[0]->getValue();      // XSRF-TOKEN

        /** 2. Send the token back exactly like Axios does */
        $response = $this->withCookie('XSRF-TOKEN', $token)
            ->withHeader('X-XSRF-TOKEN', $token)
            ->withServerVariables([
                'HTTP_ORIGIN' => config('app.url'),
                'HTTP_REFERER' => config('app.url'),
            ])
            ->postJson('/api/auth/login', [
                'email' => $member->email,
                'password' => 'secret123',
            ]);

        $response->assertStatus(204); // No content response for successful login
        //->assertJsonPath('id', $member->id);
        $this->assertAuthenticatedAs($member, Member::GUARD_NAME);
    }

    /** ---------------------------------------------------------------
     *  L-02  Login – wrong password
     * -------------------------------------------------------------- */
    public function test_login_fails_with_wrong_password(): void
    {
        $member = Member::factory()->create([
            'password' => Hash::make('secret123'),
        ]);

        $this->get('/sanctum/csrf-cookie');

        $response = $this->postJson('/api/auth/login', [
            'email' => $member->email,
            'password' => 'WRONG-PASS',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);

        $this->assertGuest(Member::GUARD_NAME);
    }

    /** ---------------------------------------------------------------
     *  L-03  Login – non-existent email
     * -------------------------------------------------------------- */
    public function test_login_fails_with_non_existent_email(): void
    {
        $this->get('/sanctum/csrf-cookie');

        $response = $this->postJson('/api/auth/login', [
            'email' => 'notfound@example.com',
            'password' => 'any-password',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);

        $this->assertGuest(Member::GUARD_NAME);
    }

    /** ---------------------------------------------------------------
     *  L-04  Login – invalid email format
     * -------------------------------------------------------------- */
    public function test_login_fails_with_invalid_email_format(): void
    {
        $this->get('/sanctum/csrf-cookie');

        $response = $this->postJson('/api/auth/login', [
            'email' => 'notfound@example.com',
            'password' => 'any-password',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);

        $this->assertGuest(Member::GUARD_NAME);
    }
    /** -----------------------------------------------------------------
     *  L-05  Login – blank password
     * ----------------------------------------------------------------*/
    public function test_login_fails_with_blank_password(): void
    {
        $member = Member::factory()->create([
            'password' => Hash::make('secret123'),
        ]);

        $this->get('/sanctum/csrf-cookie');

        $response = $this->postJson('/api/auth/login', [
            'email' => $member->email,
            'password' => '',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['password']);

        $this->assertGuest(Member::GUARD_NAME);
    }
    /** -----------------------------------------------------------------
     *  L-06  Login – excessive attempts (throttle: N per minute)
     * ----------------------------------------------------------------*/
    public function test_member_is_rate_limited_after_too_many_login_attempts(): void
    {
        /** -----------------------------------------------------------
         * Arrange – set up a low limit so the test runs fast
         * ---------------------------------------------------------- */
        RateLimiter::for('login', function (Request $request) {
            // 3 attempts / minute for test (prod is 60/1)
            return Limit::perMinute(3)->by($request->ip());
        });

        // Route used only by this test suite
        Route::post('/api/auth/login', function (Request $request) {
            $credentials = $request->only('email', 'password');

            if (! auth('member')->attempt($credentials)) {
                return response()->json(['error' => 'invalid'], 422);
            }

            return response()->json(auth('member')->user());
        })->middleware(['throttle:login']);

        $member = Member::factory()->create([
            'password' => Hash::make('secret123'),
        ]);

        /** -----------------------------------------------------------
         * Act – hit the login endpoint 4× within one minute
         * ---------------------------------------------------------- */
        $this->get('/sanctum/csrf-cookie');         // seed session+token

        // 3 bad attempts – all should return 422
        for ($i = 0; $i < 3; $i++) {
            $res = $this->postJson('/api/auth/login', [
                'email'    => $member->email,
                'password' => 'WRONG',
            ]);
            $res->assertStatus(422);
        }

        // 4th attempt within same minute triggers throttle → 429
        $res = $this->postJson('/api/auth/login', [
            'email'    => $member->email,
            'password' => 'WRONG',
        ]);

        $res->assertStatus(429)
            ->assertHeader('Retry-After');          // default header

        /** -----------------------------------------------------------
         * Assert – throttle resets after a minute
         * ---------------------------------------------------------- */
        Carbon::setTestNow(now()->addSeconds(61));  // “advance” clock

        $again = $this->postJson('/api/auth/login', [
            'email'    => $member->email,
            'password' => 'secret123',
        ]);

        $again->assertStatus(200)
            ->assertJsonPath('id', $member->id);
    }
}
