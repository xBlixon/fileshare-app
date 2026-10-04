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
    public function configure(): static
    {
        return $this

            ->afterMaking(function (File $file) {
                $file->path = 'shares/'.$file->share_id.'/';
                $file->name = $this->faker->uuid().'.txt';
            })

            ->afterCreating(function (File $file) {
                /**
                 * Since paragraph is returned as text there is no
                 * worry of contactenating string with array.
                 *
                 * @phpstan-ignore-next-line
                 */
                $contents = "Hello there!\n\n".$this->faker->paragraphs(2, true);
                $contents = substr($contents, 0, $file->size);
                Storage::put(
                    path: $file->path.$file->name,
                    contents: $contents
                );
            });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'share_id' => Share::factory(),
            'size' => 128,
        ];
    }
}
