<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->email === 'admin@example.com') {
            return $next($request);
        }

        abort(403, 'Access denied');
    }
}
