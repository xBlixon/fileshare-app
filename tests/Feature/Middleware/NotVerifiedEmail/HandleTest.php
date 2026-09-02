<?php

use App\Models\User;

it('redirects verified users to specified route', function () {
    Route::get('not-verified', fn () => 'Not verified page')
        ->middleware('not-verified:verified');

    Route::name('verified')->get('verified', fn () => 'Verified page')->name('verified');

    /**
     * Commented below is an alternative to the line above
     * Source: https://darkghosthunter.medium.com/laravel-fixing-route-not-found-319f3b6434fc
     */
//    Route::get('verified', fn () => 'Verified page')->name('verified');
//    Route::getRoutes()->refreshNameLookups();

    $verifiedUser = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $this->actingAs($verifiedUser)
        ->get('not-verified')
        ->assertRedirectToRoute('verified');
});

it('allows unverified users to proceed', function () {
    Route::get('not-verified', fn () => 'Not verified page')
        ->middleware('not-verified:verified');

    $unverifiedUser = User::factory()->unverified()->create();

    $this->actingAs($unverifiedUser)
        ->get('not-verified')
        ->assertOk(); // Status 200 - przepuszczony przez $next($request)
});
