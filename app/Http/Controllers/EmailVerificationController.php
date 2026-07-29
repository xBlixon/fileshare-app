<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class EmailVerificationController extends Controller
{
    public function notice(): Response
    {
        return Inertia::render('EmailVerification/Notice');
    }

    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        if (auth()->user()->hasVerifiedEmail()) {
            Inertia::flash('message', 'Email is already verified.');
        } else {
            $request->fulfill();
            Inertia::flash('success', 'Email verified successfully!');
        }

        return to_route('home.index');
    }

    public function send(): RedirectResponse
    {
        request()->user()->sendEmailVerificationNotification();

        Inertia::flash('message', 'Verification link sent!');

        return back();
    }
}
