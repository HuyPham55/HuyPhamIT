<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    // Use the RefreshDatabase trait to reset the database between tests
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test creating a new user.
     */
    public function test_users_can_be_created(): void
    {
        $this->seed();
        $admin = User::query()->first();
        $response = $this->actingAs($admin)
            ->postJson('/admin/users/add', data: [
                'username' => 'blogger',
                'name' => 'Blogger',
                'email' => 'admin@admin.com',
                'password' => '12345678',
                'password_confirmation' => '12345678',
                'status' => true,
                'role' => [Role::query()->first()->id],
            ]);
        $response->assertStatus(200);
    }

    /**
     * @dataProvider invalid_fields
     */
    public function test_fields_rules($field, $value, $error)
    {
        $this->seed();
        $admin = User::query()->first();
        $response = $this
            ->actingAs($admin)
            ->post('/admin/users/add', [$field => $value]);
        $response->assertSessionHasErrors([$field => $error]);
    }

    public static function invalid_fields()
    {
        return [
            'Null name' => ['name', null, 'The name field is required.'],
            'Empty name' => ['name', '', 'The name field is required.'],
            'Null username' => ['username', null, 'The username field is required.'],
            'Empty username' => ['username', '', 'The username field is required.'],
            'Short username' => ['username', 'ab', 'The username must be at least 3 characters.'],
            'Unique username' => ['username', 'admin', 'The username has already been taken.'],
        ];
    }

    /**
     * Test creating a new user.
     */
    public function test_duplicate_user_created(): void
    {
        $this->seed();
        $admin = User::query()->first();
        $response = $this->actingAs($admin)
            ->post('/admin/users/add', [
                'username' => 'admin',
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => 'admin',
                'password_confirmation' => 'admin',
            ]);
        $response->assertStatus(302);
    }

    /**
     * Test retrieving all users.
     */
    public function test_can_get_all_users()
    {
        $this->seed();
        //Logged in user:
        $user = User::query()->first();

        // Arrange: Create some users
        User::factory()->count(3)->create();

        // Act: Make a GET request to the /users endpoint
        $response = $this
            ->actingAs($user)
            ->get(route('users.list'));

        // Assert: Check the response status and structure
        $response->assertStatus(200);
    }

    /**
     * Test retrieving a single user.
     */
    public function test_can_get_a_single_user()
    {
        $this->seed();
        $admin = User::query()->first();
        // Arrange: Create a user
        $user = User::factory()->create();

        // Act: Make a GET request to the /users/{id} endpoint
        $response = $this
            ->actingAs($admin)
            ->getJson("/admin/users/edit/{$user->id}");

        // Assert: Check the response status and content
        $response->assertStatus(200);
    }

    /**
     * Test returning 404 for non-existent user.
     */
    public function test_should_return_404_if_user_not_found()
    {
        $this->seed();
        $user = User::query()->first();

        // Act: Make a GET request to a non-existent user ID
        $response = $this
            ->actingAs($user)
            ->get('/admin/users/edit/999');

        // Assert: Check that the response returns a 404 status
        $response->assertStatus(404);
    }
}
