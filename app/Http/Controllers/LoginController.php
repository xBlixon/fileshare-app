<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Auth/Login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->safe()->only(['email', 'password']);
        $remember = $request->safe()->input('remember', false);

        if (auth()->attempt($credentials, $remember)) {
            session()->regenerate();

            return redirect()->intended(route('home.index'));
        }

        return back()->withErrors(['email' => 'Invalid email or password.']);
    }
}
