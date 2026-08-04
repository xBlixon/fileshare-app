<?php

use App\Http\Controllers\FileController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('file/{file}', [FileController::class, 'show'])->name('file.show');
});
