<?php

namespace Database\Factories;

use App\Models\File;
use App\Models\Share;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends Factory<File>
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
        $share = Share::factory()->create();
        $path = 'shares/'.$share->id.'/'.$this->faker->uuid().'.txt';

        Storage::put(
            path: $path,
            contents: "Hello there!\n\n"
            .$this->faker->paragraph()
        );

        return [
            'share_id' => $share,
            'path' => $path,
        ];
    }
}
