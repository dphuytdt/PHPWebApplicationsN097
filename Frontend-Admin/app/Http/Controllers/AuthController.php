<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public $userService = 'http://userservice.test:8080/api/';
    public function login()
    {
        $role = session()->get('role');
        if (session()->has('token') && $role == 0) {
            return redirect()->intended('/');
        }
        return view('auth.login')->with('error', 'You must login to continue');
    }

    public function postLogin(Request $request)
    {
        $http = new Client;
        $response = $http->post($this->userService . 'auth/login', [
            'json' => [
                'email' => $request->email,
                'password' => $request->password,
            ]
        ]);
        $data = json_decode((string) $response->getBody(), true);
        // dd($data);
        if (isset($data['access_token'])) {
            $user = $data['user'];
            session()->put('token', $data['access_token']);
            session()->put('user', $user);
            session()->put('role', $user['role_id']);
            return redirect()->intended('/');
        } else {
            return redirect()->back()->with('error', 'Wrong email or password');
        }
    }

    public function logout()
    {
        $http = new Client();
        try {
            $http->post($this->userService. 'auth/logout', [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('token'), // Truyền token từ session
                ],
            ]);
            session()->forget('token');
            session()->forget('user');
            session()->forget('role');
            return redirect()->route('login')->with('message', 'Logout successful');
        } catch (\Exception $e) {
            // Lỗi xảy ra hoặc logout thất bại
            return redirect()->route('login')->with('error', 'Logout failed');
        }
    }
}
