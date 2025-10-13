<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => fake()->imageUrl(),
            'title' => fake()->title(),
            'content' => fake()->text(),
            'hash' => fake()->unique()->slug(),
            'status' => fake()->boolean(),
            'user_id' => 1,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
