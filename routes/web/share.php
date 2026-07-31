<?php

use App\Http\Controllers\ShareController;

Route::prefix('share')->group(function () {
    Route::get('new', [ShareController::class, 'index'])->name('share.index');
});
