<?php

namespace Database\Seeders;

use App\Models\Share;
use Database\Factories\FileFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Share::all()->each(function (Share $share) {

            FileFactory::new()
                ->for($share)
                ->count(rand(1, 5))
                ->create();
        });
    }
}
