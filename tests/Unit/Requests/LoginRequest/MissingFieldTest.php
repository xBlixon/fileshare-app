<?php

use App\Http\Requests\LoginRequest;

it('is missing an email', function () {
    $request = new LoginRequest;
    $validator = Validator::make([
        'password' => '12345678',
    ], $request->rules());
    expect($validator->fails())->toBeTrue();
});

it('is missing a password', function () {
    $request = new LoginRequest;
    $validator = Validator::make([
        'email' => 'foo@bar.baz',
    ], $request->rules());
    expect($validator->fails())->toBeTrue();
});
