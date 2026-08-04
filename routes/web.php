<?php

require __DIR__.'/web/register.php';
require __DIR__.'/web/email-verification.php';
require __DIR__.'/web/login.php';
require __DIR__.'/web/logout.php';

require __DIR__.'/web/share.php';
require __DIR__.'/web/file.php';

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
