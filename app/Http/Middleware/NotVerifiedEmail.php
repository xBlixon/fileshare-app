<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotVerifiedEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $routeName): Response|RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return to_route($routeName);
        }

        return $next($request);
    }
}
