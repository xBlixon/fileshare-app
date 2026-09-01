<?php

use App\Models\Share;
use App\Models\User;
use Illuminate\Http\UploadedFile;

it('creates a new share', function () {
    $this->actingAs(User::factory()->create());

    $file = UploadedFile::fake()->image('image.jpg');
    $this->post(route('share.store'),
        [
            'title' => 'Title',
            'description' => 'Description',
            'files' => [$file],
        ])->assertRedirectToRoute('share.show', Share::latest()->first())
        ->assertInertiaFlash('success', 'Your share has been created!');

    expect(Share::count())->toBe(1);
});
