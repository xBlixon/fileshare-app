<?php

use App\Models\File;

it('shows file', function () {
    $file = File::factory()->create();
    $this->actingAs($file->share->user);

    $response = $this->get(route('file.show', $file));
    $response->assertOk();
    expect($response->streamedContent())->toContain('Hello there!');
});
