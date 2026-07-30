<?php

use App\Http\Controllers\LogoutController;

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
