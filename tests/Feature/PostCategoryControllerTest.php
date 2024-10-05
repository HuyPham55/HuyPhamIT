<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class PostCategoryControllerTest extends TestCase
{
    public function test_post_categories_index()
    {
        $user = User::query()->first();
        $response = $this->actingAs($user)
            ->get(route('post_categories.list'));
        $response->assertStatus(200);
    }

    public function test_post_categories_add() {
        $user = User::query()->first();
        $response = $this->actingAs($user)
            ->get(route('post_categories.add'));
        $response->assertStatus(200);
    }
}
