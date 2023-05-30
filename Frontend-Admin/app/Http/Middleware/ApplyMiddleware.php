<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplyMiddleware
{
    public function handle($request, Closure $next, $middleware)
    {
        $middlewares = explode('|', $middleware);

        foreach ($middlewares as $middlewareName) {
            $request->route()->middleware($middlewareName);
        }

        return $next($request);
    }
}
