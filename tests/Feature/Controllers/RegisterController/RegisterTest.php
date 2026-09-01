<?php

use App\Models\User;

it('registers a new user', function () {
    $this->post(
        route('register.store'),
        [
            'name' => 'John Doe',
            'email' => 'foo@bar.baz',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

    expect(User::count())
        ->toBe(1);

    $user = User::first();
    expect($user->name)
        ->toBe('John Doe')
        ->and($user->email)
        ->toBe('foo@bar.baz');
});
