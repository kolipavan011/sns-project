<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

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
                'name' => fake()->word(),
                'size' => '2MB',
                'type' => 'jpg/image',
            ],
            //'created_at' => $this->randomDate()
        ];
    }

    private function randomDate()
    {

        $hiredOn = (new Carbon)->parse('2023-10-04');
        $sixMonthsAgo = Carbon::now()->subWeek(1);

        // How many days between two dates
        $diffInDays = $sixMonthsAgo->diffInDays($hiredOn);

        // Get a random number in the range of $diffInDays
        $randomDays = rand(0, $diffInDays);

        //add that many days to $hiredOn
        $randomDate = $sixMonthsAgo->addDays($randomDays);

        return $randomDate;
    }
}
