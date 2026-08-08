<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LogoutController extends Controller
{
    public function logout(): RedirectResponse
    {
        auth()->logout();

        return to_route('login.index');
    }
}
