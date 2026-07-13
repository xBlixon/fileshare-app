<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RegisterController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Auth/Register',
            [

            ]);
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json([
            'to' => 'do',
        ]);
    }
}
