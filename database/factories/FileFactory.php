<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid,
            'path' => fake()->imageUrl(),
            'type' => 'image',
            'user_id' => fake()->uuid,
            'folder_id' => fake()->uuid,
            'detail' => [
                'size' => '2MB',
                'type' => 'jpg/image',
            ],
        ];
    }
}
