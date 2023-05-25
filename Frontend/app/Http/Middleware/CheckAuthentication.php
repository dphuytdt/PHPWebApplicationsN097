<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthentication
{
    public function handle($request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (!session()->has('token')) {
            // Người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
            return redirect()->route('login')->with('error', 'Please login');
        }

        return $next($request);
    }
}
