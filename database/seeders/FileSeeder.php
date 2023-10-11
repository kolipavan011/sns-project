<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\FileManager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        File::factory()->count(10)->state(new Sequence(
            fn (Sequence $sequence) => ['user_id' => User::all()->random(), 'folder_id' => FileManager::all()->random()]
        ))->create();
    }
}
