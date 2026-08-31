<?php

use App\Http\Requests\StoreShareRequest;
use Illuminate\Http\UploadedFile;

it('is a valid share request', function () {
    $request = new StoreShareRequest;
    $file = UploadedFile::fake()->image('image.jpg');

    $validator = Validator::make([
        'title' => 'Title',
        'description' => 'Description',
        'files' => [$file],
    ], $request->rules());
    expect($validator->passes())->toBeTrue();
});
