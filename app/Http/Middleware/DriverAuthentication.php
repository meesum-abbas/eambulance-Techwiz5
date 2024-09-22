<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class DriverAuthentication
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->rolefk !== 2) {
            return redirect('/login')->with('error', 'You must be an admin to access this page.');
        }

        return $next($request);
    }
}
