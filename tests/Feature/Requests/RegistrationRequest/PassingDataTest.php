<?php

use App\Http\Requests\RegistrationRequest;

it('is a valid registration request', function () {
    $request = new RegistrationRequest();
    $validator = Validator::make([
        'name' => 'John Doe',
        'email' => 'foo@bar.baz',
        'password' => '12345678',
    ], $request->rules());
    expect($validator->fails())->toBeTrue();
});
