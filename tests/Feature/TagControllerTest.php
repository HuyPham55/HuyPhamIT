<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    public function test_tags_list()
    {
        $user = User::query()->first();
        $response = $this->actingAs($user)
            ->get(route('tags.datatables'));
        $response->assertStatus(200);
    }

    public function test_tags_add() {
        $user = User::query()->first();
        $response = $this->actingAs($user)
            ->get(route('tags.add'));
        $response->assertStatus(200);
    }
}
