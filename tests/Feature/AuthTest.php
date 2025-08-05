<?php

namespace Tests\Feature;

use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
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
}
