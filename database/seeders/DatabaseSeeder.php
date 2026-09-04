<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\Share;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        UserFactory::new()->has(
            Share::factory()->has(
                File::factory()->count(2)
            )
        )
            ->create(
                [
                    'name' => 'John Doe',
                    'email' => 'me@me.me',
                    'password' => 'password',
                ]);

        $this->call([
            UserSeeder::class,
            ShareSeeder::class,
            FileSeeder::class,
        ]);
    }
}
