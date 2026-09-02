<?php

use App\Models\User;

it('logs in a user', function () {
    $email = 'foo@bar.baz';
    $password = 'password';
    $user = User::create(
        [
            'name' => 'John Doe',
            'email' => $email,
            'password' => $password,
        ]);

    $this->post(
        route('login.login'),
        [
            'email' => $email,
            'password' => $password,
        ]);

    $this->assertAuthenticatedAs($user);
});

it('rejects invalid email', function () {
    $email = 'foo@bar.baz';
    $password = 'password';
    $user = User::create(
        [
            'name' => 'John Doe',
            'email' => $email,
            'password' => $password,
        ]);

    $this->fromRoute('login.index')
        ->post(route('login.login'),
            [
                'email' => 'wrong@email.net',
                'password' => $password,
            ])
        ->assertRedirectToRoute('login.index')
        ->assertSessionHasErrors(['email' => 'Invalid email or password.']);
});

it('rejects invalid password', function () {
    $email = 'foo@bar.baz';
    $password = 'password';
    $user = User::create(
        [
            'name' => 'John Doe',
            'email' => $email,
            'password' => $password,
        ]);

    $this->fromRoute('login.index')
        ->post(route('login.login'),
            [
                'email' => $email,
                'password' => 'wrong_password',
            ])
        ->assertRedirectToRoute('login.index')
        ->assertSessionHasErrors(['email' => 'Invalid email or password.']);
});

it('errors missing email', function () {
    $email = 'foo@bar.baz';
    $password = 'password';
    User::create(
        [
            'name' => 'John Doe',
            'email' => $email,
            'password' => $password,
        ]);

    $this->fromRoute('login.index')
        ->post(route('login.login'),
            [
                'password' => $password,
            ])
        ->assertRedirectToRoute('login.index')
        ->assertSessionHasErrors(['email' => 'The email field is required.']);
});
