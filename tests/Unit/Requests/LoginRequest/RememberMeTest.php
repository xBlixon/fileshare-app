<?php

use App\Http\Requests\LoginRequest;

it('validates login request without remember me field', function () {
    $request = new LoginRequest;
    $validator = Validator::make([
        'email' => 'foo@bar.baz',
        'password' => '12345678',
    ], $request->rules());
    expect($validator->passes())->toBeTrue();
});

it('validates login request with remember me field set to false', function () {
    $request = new LoginRequest;
    $validator = Validator::make([
        'email' => 'foo@bar.baz',
        'password' => '12345678',
        'remember' => false,
    ], $request->rules());
    expect($validator->passes())->toBeTrue();
});

it('validates login request with remember me field set to true', function () {
    $request = new LoginRequest;
    $validator = Validator::make([
        'email' => 'foo@bar.baz',
        'password' => '12345678',
        'remember' => true,
    ], $request->rules());
    expect($validator->passes())->toBeTrue();
});
