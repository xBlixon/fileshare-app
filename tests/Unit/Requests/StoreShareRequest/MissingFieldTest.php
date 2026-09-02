<?php

use App\Http\Requests\StoreShareRequest;
use Illuminate\Http\UploadedFile;

it('is missing a title', function () {
    $request = new StoreShareRequest;
    $file = UploadedFile::fake()->image('image.jpg');

    $validator = Validator::make([
        'description' => 'Description',
        'files' => [$file],
    ], $request->rules());
    expect($validator->fails())->toBeTrue();
});

it('is missing a description', function () {
    $request = new StoreShareRequest;
    $file = UploadedFile::fake()->image('image.jpg');

    $validator = Validator::make([
        'title' => 'Title',
        'files' => [$file],
    ], $request->rules());
    expect($validator->fails())->toBeTrue();
});

it('is missing files', function () {
    $request = new StoreShareRequest;
    $validator = Validator::make([
        'title' => 'Title',
        'description' => 'Description',
    ], $request->rules());
    expect($validator->fails())->toBeTrue();
});
