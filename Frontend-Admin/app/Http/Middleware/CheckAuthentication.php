<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthentication
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('adminToken')) {
            return redirect()->route('login')->with('error', 'Please login');
        }

        return $next($request);
    }
}
