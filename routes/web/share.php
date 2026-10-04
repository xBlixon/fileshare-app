<?php

use App\Http\Controllers\ShareController;

Route::prefix('share')->middleware(['auth', 'verified'])->group(function () {
    Route::get('all', [ShareController::class, 'index'])->name('share.index');
    Route::get('new', [ShareController::class, 'create'])->name('share.create');
    Route::get('{share}', [ShareController::class, 'show'])->name('share.show');
    Route::get('{share}/edit', [ShareController::class, 'edit'])->name('share.edit');

    Route::post('new', [ShareController::class, 'store'])->name('share.store');

    Route::patch('{share}/edit', [ShareController::class, 'update'])->name('share.update');

    Route::delete('{share}/delete', [ShareController::class, 'destroy'])->name('share.destroy');
});
