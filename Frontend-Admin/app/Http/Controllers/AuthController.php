<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class AuthController extends Controller
{
    protected $bookService, $contentService, $userService, $paymentService, $interactionService;

    public function __construct()
    {
        $this->bookService = env('BOOK_SERVICE_HOST', null);
        $this->contentService = env('CONTENT_MANAGEMENT_SERVICE_HOST', null);
        $this->userService = env('USER_SERVICE_HOST', null);
        $this->paymentService = env('PAYMENT_SERVICE_HOST', null);
        $this->interactionService = env('INTERACTION_SERVICE_HOST', null);
    }

    public function login()
    {
        $role = session()->get('role_id');

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
                Log::info('User: ' . $request->email . ' login');
                return redirect()->intended('/');
            } else {
                Log::error('User: ' . $request->email . ' login failed');
                return redirect()->back()->with('error', 'Wrong email or password')->withInput();
            }
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Wrong email or password')->withInput();
        }
    }

    public function logout()
    {
        $http = new Client();
        try {
            $http->post($this->userService. 'auth/admin/logout', [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('token'),
                ],
            ]);
            session()->forget('token');
            session()->forget('user');
            session()->forget('role_id');
            Auth::logout();
            Log::info('User: ' . session('user')['email'] . ' logout');
            return redirect()->route('login')->with('message', 'Logout successful');
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
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
                Log::info('User: ' . $request->email . ' request reset password');
                return redirect()->back()->with('message', $data['message']);
            } else {
                Log::error('User: ' . $request->email . ' request reset password failed');
                return redirect()->back()->with('error', $data['error'])->withInput();
            }
        } catch (\Exception $e) {
            Log::error('User: ' . $request->email . ' request reset password failed because email does not exist');
            return redirect()->back()->with('error', 'Email does not exist')->withInput();
        }
    }
}
