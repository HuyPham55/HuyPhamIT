<?php

namespace Tests\Feature;

use App\Contracts\Services\PostCategoryServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class PostCategoryControllerTest extends TestCase
{
    // Seed user data before running tests
    protected function setUp(): void {
        parent::setUp();
        $this->artisan('db:seed');
    }
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

    public function test_post_categories_can_be_added()
    {
        /*
         * TODO: Testing a service container
         * https://laracasts.com/discuss/channels/testing/how-can-i-test-a-class-that-has-dependencies-injected-by-the-container
         */
        $data = [];
        $lang =  array_map(function($item) { return $item['title']; }, config('lang'));
        foreach ($lang as $langKey => $langTitle) {
            $data[$langKey]["title"] = fake()->name;
            $data[$langKey]["image"] = "/images/no-image.png";
        }
        $data['status'] = true;
        $service = App::make(PostCategoryServiceInterface::class);
        $response = $service->create($data);
        $this->assertTrue($response);
    }

}
