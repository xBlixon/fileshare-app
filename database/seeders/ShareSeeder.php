<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\ShareFactory;
use Illuminate\Database\Seeder;

class ShareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            ShareFactory::new()
                ->for($user)
                ->count(rand(0, 3))
                ->create();
        });
    }
}
