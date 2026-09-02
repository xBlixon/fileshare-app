<?php

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;

it('resends the verification email', function () {
    Notification::fake();

    $user = User::factory()->unverified()->create();

    $this->actingAs($user)
        ->from(route('verification.notice'))
        ->post(route('verification.send'))
        ->assertRedirect(route('verification.notice'));

    Notification::assertSentTo($user, VerifyEmail::class);
});

it('requires authentication to resend verification email', function () {
    $this->post(route('verification.send'))
        ->assertRedirect(route('login.index'));
});
