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

    public function test_post_can_be_added()
    {
        $user = User::query()->first();
        $data = [];
        $lang = array_map(function ($item) {
            return $item['title'];
        }, config('lang'));
        foreach ($lang as $langKey => $langTitle) {
            $data[$langKey]["title"] = fake()->name;
            $data[$langKey]["image"] = "/images/no-image.png";
            $data[$langKey]["content"] = fake()->text(500);
        }
        $data['status'] = true;
        $response = $this->actingAs($user)
            ->post(route('posts.add'), data: $data);
        $response->assertStatus(302);
    }
}
