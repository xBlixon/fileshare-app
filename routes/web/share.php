<?php

use App\Http\Controllers\ShareController;

Route::prefix('share')->middleware(['auth', 'verified'])->group(function () {
    Route::get('all', [ShareController::class, 'index'])->name('share.index');
    Route::get('new', [ShareController::class, 'create'])->name('share.create');
});
