<?php

use App\Http\Controllers\EmailVerificationController;
use Illuminate\Support\Facades\Route;

// Redirects to home.index route if verified - no need to verify again.
Route::middleware(['auth', 'not-verified:home.index'])->group(function () {
    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware(['signed'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])
        ->middleware(['throttle:6,1'])->name('verification.send');
});
