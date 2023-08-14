<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Locale
{
    public function handle($request, Closure $next)
    {
        $language = Session::get('website_language', config('app.locale'));

        config(['app.locale' => $language]);

        return $next($request);
    }
}
