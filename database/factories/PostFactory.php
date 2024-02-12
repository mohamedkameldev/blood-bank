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
            'title' => fake()->word(), 
            'content' => fake()->sentence(),
            'photo_path' => fake()->imageUrl(640, 480, 'Post', true),
            // 'category_id' => fake()->randomDigitNot(0),
            'category_id' => fake()->randomDigitNotNull(),
        ];
    }
}
