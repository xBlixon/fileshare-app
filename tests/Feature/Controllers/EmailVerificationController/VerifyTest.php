<?php

use App\Models\User;
use Illuminate\Auth\Events\Verified;

it('verifies email with a valid signed url', function () {
    Event::fake();

    $user = User::factory()->unverified()->create();

    $url = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        [
            'id' => $user->id,
            'hash' => sha1($user->email),
        ]
    );

    $this->actingAs($user)
        ->get($url)
        ->assertRedirect(route('home.index'));

    expect($user->fresh()->hasVerifiedEmail())->toBeTrue();

    Event::assertDispatched(Verified::class);
});

it('does not re-fire verified event if already verified', function () {
    Event::fake();

    $user = User::factory()->create(); // Verified

    $url = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        [
            'id' => $user->id,
            'hash' => sha1($user->email),
        ]
    );

    $this->actingAs($user)
        ->get($url)
        ->assertRedirect(route('home.index'));

    Event::assertNotDispatched(Verified::class);
});

it('rejects invalid verification hash', function () {
    $user = User::factory()->unverified()->create();

    $url = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        [
            'id' => $user->id,
            'hash' => sha1('wrong@email.com'),
        ]
    );

    $this->actingAs($user)
        ->get($url)
        ->assertForbidden();

    expect($user->fresh()->hasVerifiedEmail())->toBeFalse();
});

it('rejects expired signed url', function () {
    $user = User::factory()->unverified()->create();

    $url = URL::temporarySignedRoute(
        'verification.verify',
        now()->subMinutes(1), // Expired 1 minute ago
        [
            'id' => $user->id,
            'hash' => sha1($user->email),
        ]
    );

    $this->actingAs($user)
        ->get($url)
        ->assertForbidden();

    expect($user->fresh()->hasVerifiedEmail())->toBeFalse();
});
