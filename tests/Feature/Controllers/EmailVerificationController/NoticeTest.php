<?php

use App\Models\User;

it('shows the verification notice for unverified users', function () {
    $user = User::factory()->unverified()->create();

    $this->actingAs($user)
        ->get(route('verification.notice'))
        ->assertOk()
        ->assertInertia(fn ($page) => $page->component('EmailVerification/Notice'));
});

it('redirects verified users away from the notice page', function () {
    $user = User::factory()->create(); // Verified by default

    $this->actingAs($user)
        ->get(route('verification.notice'))
        ->assertRedirect(route('home.index'));
});

it('redirects guests trying to view the notice page', function () {
    $this->get(route('verification.notice'))
        ->assertRedirect(route('login.index'));
});
