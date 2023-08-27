<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{

    public function index()
    {
        Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' access to dashboard' );
        return view('home.dashboard');
    }

    public function handleError()
    {
        Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' have trouble with server' );
        return view('errors.404');
    }
}
