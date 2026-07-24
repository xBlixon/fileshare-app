<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class RegisterController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Auth/Register');
    }

    public function store(RegistrationRequest $request): RedirectResponse
    {

        $user = User::create($request->validated());
        event(new Registered($user)); // TODO email confirmation

        Inertia::flash([
            'success' => 'Confirm your email to activate your account.',
        ]);

        return to_route('login.index');
    }
}
