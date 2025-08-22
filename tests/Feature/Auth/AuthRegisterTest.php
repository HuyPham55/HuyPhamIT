<?php

namespace Tests\Feature\Auth;

use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthRegisterTest extends TestCase
{
    use RefreshDatabase;

    // reset DB between tests

    /** -----------------------------------------------------------------
     *  R-01  Register – happy path
     * ----------------------------------------------------------------*/
    public function test_member_can_register_and_is_immediately_logged_in(): void
    {
        // Sanctum (cookie) flow needs a CSRF token first
        $this->get('/sanctum/csrf-cookie');

        $payload = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        /** @see AuthenticatedSessionController::destroy() */
        //$response->assertStatus(200)->assertJsonPath('email', 'jane@example.com');
        $response->assertStatus(204);

        $this->assertDatabaseHas('members', [
            'email' => 'jane@example.com',
        ]);

        // Assertion helper automatically checks the 'member' guard if given
        $this->assertAuthenticated('member');
    }


    /** -----------------------------------------------------------------
     *  R-02  Register – missing name
     * ----------------------------------------------------------------*/
    public function test_register_fails_when_name_is_missing(): void
    {
        // Step 1: Get CSRF token for Sanctum
        $this->get('/sanctum/csrf-cookie');

        // Step 2: Prepare payload without the required 'name' field
        $payload = [
            'email'    => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        // Step 3: Post to /register API endpoint
        $response = $this->postJson('/api/auth/register', $payload);

        // Step 4: Assert validation error for missing 'name'
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name']);

        // Step 5: Verify that no user was created
        $this->assertDatabaseMissing('members', [
            'email' => 'john@example.com',
        ]);
    }

    /** -----------------------------------------------------------------
     *  R-03 Register – invalid email
     * ----------------------------------------------------------------*/
    public function test_registration_fails_with_invalid_email(): void {
        $this->get('/sanctum/csrf-cookie');

        $payload = [
            'name' => 'Jane Doe',
            'email' => 'not-an-email',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);

        // No user should be created
        $this->assertDatabaseMissing('members', [
            'email' => 'not-an-email',
        ]);

        // Not authenticated
        $this->assertGuest(Member::GUARD_NAME);
    }

    /** -----------------------------------------------------------------
     *  R-05 Register – password mismatch
     * ----------------------------------------------------------------*/
    public function test_registration_fails_with_password_mismatch(): void {
        $this->get('/sanctum/csrf-cookie');

        $payload = [
            'name' => 'Jane Doe',
            'email' => 'jane2@example.com',
            'password' => 'secret123',
            'password_confirmation' => 'different123',
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['password']);

        $this->assertDatabaseMissing('members', [
            'email' => 'jane2@example.com',
        ]);

        $this->assertGuest(Member::GUARD_NAME);
    }

    /** -----------------------------------------------------------------
     *  R-06 Register – duplicate email
     * ----------------------------------------------------------------*/
    public function test_registration_fails_with_duplicate_email(): void
    {
        $this->get('/sanctum/csrf-cookie');

        // Create an existing member
        Member::factory()->create([
            'email' => 'jane@example.com',
        ]);

        $payload = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);

        // No duplicate should be created
        $this->assertEquals(1, Member::where('email', 'jane@example.com')->count());

        $this->assertGuest(Member::GUARD_NAME);
    }

}
