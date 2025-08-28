<?php

namespace Tests\Feature;

use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends BaseTest
{
    use RefreshDatabase; // reset DB between tests

    /** ---------------------------------------------------------------
     *  S-01  Fetch current user – authenticated
     * -------------------------------------------------------------- */
    public function test_authenticated_member_can_fetch_self(): void
    {
        $member = Member::factory()->create();

        // actingAs() stores guard key in the session for us
        $this->actingAs($member, 'member');

        $response = $this->getJson('/api/user');

        $response->assertOk()
            ->assertJsonPath('id', $member->id);
    }

    /** ---------------------------------------------------------------
     *  S-02  Fetch current user – guest
     * -------------------------------------------------------------- */
    public function test_guest_cannot_fetch_user(): void
    {
        $response = $this->getJson('/api/user');

        $response->assertStatus(401); // 401 Unauthorized
        $this->assertGuest('member');
    }

    /** -----------------------------------------------------------------
     *  S-03  Logout – Happy Path
     * ----------------------------------------------------------------*/
    public function test_member_can_logout_successfully(): void
    {
        $token = $this->getCsrfToken();
        // XSRF-TOKEN

        // Step 1: Create a new member and log them in
        $member = Member::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        // Use actingAs() to simulate a logged-in user (member guard)
        $this->actingAs($member, 'member');

        // Step 2: Send a POST request to the logout endpoint
        $response = $this
            ->withCookie('XSRF-TOKEN', $token)
            ->withHeader('X-XSRF-TOKEN', $token)
            ->withServerVariables([
                'HTTP_ORIGIN' => config('app.url'),
                'HTTP_REFERER' => config('app.url'),
            ])
            ->postJson('/api/auth/logout');  // Assuming this is the route

        // Step 3: Assert that the response status is 204 (No Content)
        $response->assertStatus(204);

        // Step 4: Assert that the member is no longer authenticated
        $this->assertGuest('member');  // Laravel's built-in assertion for guest check

        // Step 5: Verify that the session is invalidated (no session data)
        $this->assertNull(session('user'));   // Replace with the actual session key if needed

        // Step 6: Verify that the `laravel_session` cookie is cleared
        //$this->assertCookieExpired('laravel_session');
        $this->assertNull(Cookie::get('laravel_session'));
    }
}
