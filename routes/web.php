<?php

require __DIR__.'/web/email-verification.php';
require __DIR__.'/web/register.php';
require __DIR__.'/web/login.php';
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
