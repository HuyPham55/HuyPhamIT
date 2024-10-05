<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    public function test_posts_datatables()
    {
        $user = User::query()->first();
        $response = $this->actingAs($user)
            ->get(route('posts.datatables'));
        $response->assertStatus(200);
    }

    public function test_posts_add() {
        $user = User::query()->first();
        $response = $this->actingAs($user)
            ->get(route('posts.add'));
        $response->assertStatus(200);
    }
}
