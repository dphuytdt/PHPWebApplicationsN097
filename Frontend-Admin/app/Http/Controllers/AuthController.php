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
        $role = session()->get('role_id');
        // dd($role);
        if (session()->has('token') && $role == 0) {
            return redirect()->intended('/');
        }
        return view('auth.login')->with('error', 'You must login to continue');
    }

    public function postLogin(Request $request)
    {
        $http = new Client;
        try {
            $response = $http->post($this->userService . 'auth/admin/login', [
                'json' => [
                    'email' => $request->email,
                    'password' => $request->password,
                ]
            ]);
            $data = json_decode((string) $response->getBody(), true);

            if (isset($data['access_token'])) {
                $user = $data['user'];
                session()->put('token', $data['access_token']);
                session()->put('user', $user);
                session()->put('role_id', $user['role_id']);
                return redirect()->intended('/');
            } else {
                return redirect()->back()->with('error', 'Wrong email or password')->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Wrong email or password')->withInput();
        }
    }

    public function logout()
    {
        $http = new Client();
        try {
            $http->post($this->userService. 'auth/admin/logout', [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('token'), // Truyền token từ session
                ],
            ]);
            session()->forget('token');
            session()->forget('user');
            session()->forget('role_id');
            Auth::logout();
            return redirect()->route('login')->with('message', 'Logout successful');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Logout failed');
        }
    }

    public function requestResetPassword()
    {
        return view('auth.request-reset-password');
    }

    public function postRequestResetPassword(Request $request)
    {
        $http = new Client;
        try {
            $response = $http->post($this->userService . 'auth/admin/request-reset-password', [
                'json' => [
                    'email' => $request->email,
                ]
            ]);
            $data = json_decode((string) $response->getBody(), true);
            if (isset($data['message'])) {
                return redirect()->back()->with('message', $data['message']);
            } else {
                return redirect()->back()->with('error', $data['error'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Email does not exist')->withInput();
        }
    }
}
