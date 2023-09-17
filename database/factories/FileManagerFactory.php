<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FileManager>
 */
class FileManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $word = fake()->word;

        return [
            'id' => fake()->uuid,
            'folder_name' => $word,
            'folder_slug' => substr($word, 0, 5),
            'folder_parent' => '00000000-00000000-00000000-00000000',
        ];
    }
}
