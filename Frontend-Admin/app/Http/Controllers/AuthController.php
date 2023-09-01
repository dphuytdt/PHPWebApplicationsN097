<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
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
        $role = session()->get('adminRole');

        if (session()->has('adminToken') && $role ==  'ROLE_ADMIN') {
            return redirect()->intended('/');
        }

        return view('auth.login')->with('error', 'You must login to continue');
    }

    public function postLogin(Request $request)
    {
        $http = new Client();

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
                session()->put('adminToken', $data['access_token']);
                session()->put('admin', $user);
                session()->put('adminRole', $user['role']);

                Log::channel('admin_log')->info('Admin: ' . $request->email . ' login success' );

                return redirect()->intended('/');
            } else {

                Log::channel('admin_log')->error('Admin: ' . $request->email . ' login failed' );
                return redirect()->back()->with('error', 'Wrong email or password')->withInput();
            }
        } catch (\Exception|GuzzleException $e) {
            dd($e);
            Log::channel('admin_log')->error('Admin: ' . $request->email . ' login failed' );
            return redirect()->back()->with('error', 'Wrong email or password')->withInput();
        }
    }

    public function logout()
    {
        $http = new Client();


        session()->forget('adminToken');
        session()->forget('admin');
        session()->forget('adminRole');

        try {
            $http->post($this->userService. 'auth/admin/logout', [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('adminToken'),
                ],
            ]);

            Log::channel('admin_log')->info('Admin: ' . session('admin')['email'] . ' logout success' );

            return redirect()->route('login')->with('message', 'Logout successful');
        } catch (\Exception|GuzzleException $e) {
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
                Log::channel('admin_log')->info('Admin: ' . $request->email . ' request reset password success' );
                return redirect()->back()->with('message', $data['message']);
            } else {
                Log::channel('admin_log')->error('Admin: ' . $request->email . ' request reset password failed because email does not exist' );
                return redirect()->back()->with('error', $data['error'])->withInput();
            }
        } catch (\Exception $e) {
            Log::channel('admin_log')->error('Admin: ' . $request->email . ' request reset password failed because email does not exist' );
            return redirect()->back()->with('error', 'Email does not exist')->withInput();
        }
    }
}
