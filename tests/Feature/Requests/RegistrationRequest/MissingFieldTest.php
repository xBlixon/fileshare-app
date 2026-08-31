<?php

use App\Http\Requests\RegistrationRequest;

it('is missing a name', function () {
    $request = new RegistrationRequest();
    $validator = Validator::make([
        'email' => 'foo@bar.baz',
        'password' => '12345678',
    ], $request->rules());
    expect($validator->fails())->toBeTrue();
});

it('is missing an email', function () {
    $request = new RegistrationRequest();
    $validator = Validator::make([
        'name' => 'John Doe',
        'password' => '12345678',
    ], $request->rules());
    expect($validator->fails())->toBeTrue();
});

it('is missing a password', function () {
    $request = new RegistrationRequest();
    $validator = Validator::make([
        'email' => 'foo@bar.baz',
    ], $request->rules());
    expect($validator->fails())->toBeTrue();
});
