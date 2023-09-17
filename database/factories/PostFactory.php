<?php

namespace Database\Factories;

use App\Models\User;
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
        $user = User::all()->random();

        return [
            'id' => fake()->uuid,
            'slug' => fake()->slug,
            'title' => fake()->word,
            'summary' => fake()->sentence,
            'body' => fake()->realText(),
            'published_at' => today()->toDateTimeString(),
            'featured_image' => fake()->imageUrl(),
            'user_id' => $user->id,
            'meta' => [
                'title' => fake()->sentence,
                'description' => fake()->sentence,
                'canonical_link' => fake()->sentence
            ],
        ];
    }
}
