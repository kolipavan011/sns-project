<?php

namespace Database\Seeders;

use App\Models\FileManager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class FileManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = FileManager::all();

        FileManager::factory()->count(10)->state(new Sequence(
            fn (Sequence $sequence) => ['folder_parent' => $files->count() > 0 ? $files->random() : FileManager::query()->make(['id' => '00000000-00000000-00000000-00000000'])]
        ))->create();
    }
}
