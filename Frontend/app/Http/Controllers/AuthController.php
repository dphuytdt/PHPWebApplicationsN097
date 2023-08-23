<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    protected $categoryService, $bookService, $contentService, $userService, $paymentService, $interactionService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->bookService = env('BOOK_SERVICE_HOST', null);
        $this->contentService = env('CONTENT_MANAGEMENT_SERVICE_HOST', null);
        $this->userService = env('USER_SERVICE_HOST', null);
        $this->paymentService = env('PAYMENT_SERVICE_HOST', null);
        $this->interactionService = env('INTERACTION_SERVICE_HOST', null);
    }

    public function login()
    {
        if (session()->has('token')) {
            return redirect()->intended('/');
        }

        $categories = $this->categoryService->getCategory();

        return view('auth.login')->with('categories', $categories);
    }

    public function postLogin(Request $request)
    {
        $client = new Client();

        try {
            $response = $client->post($this->userService . 'auth/login', [
                'json' => $request->all(),
            ]);

            $result = json_decode($response->getBody(), true);
            $user = $result['user'];

            if (isset($result['access_token'])) {
                session()->put('token', $result['access_token']);
                session()->put('user', $user);
                session()->put('user_id', $user['id']);
                session()->put('role', $user['role']);

                return redirect()->intended('/');
            } else {
                return redirect()->route('login')->with('error', 'Invalid credentials')->withInput();
            }
        } catch (\Exception|GuzzleException $e) {
            if ($e->getCode() == 400) {
                return redirect()->route('login')->with('error', 'You must verify email before login')->withInput();
            } else {
                return redirect()->route('login')->with('error', 'Wrong email or password')->withInput();
            }
        }
    }

    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        $client = new Client();

        try {
            $response = $client->post($this->userService . 'auth/logout', [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('token'),
                ],
            ]);

            session()->forget('token');
            session()->forget('user');
            session()->forget('role');
            session()->forget('user_id');

            Session::forget('wishlist');

            return redirect()->intended('/')->with('message', 'Logout successful');
        } catch (\Exception|GuzzleException $e) {
            return redirect()->intended('/')->with('error', 'Logout failed');
        }
    }


    public function postRegister(Request $request)
    {
        $client = new Client();

        try {
            $response = $client->post($this->userService . 'auth/register', [
                'json' => $request->all(),
            ]);

            $result = json_decode($response->getBody(), true);
            if (isset($result['message'])) {
                session()->put('emailRegister', $request->email);
                return redirect()->route('login')->with('message', 'Register successful. Check your email to verify account');
            } else {
                return redirect()->route('login')->with('error', 'Register failed');
            }

        } catch (\Exception|GuzzleException $e) {
            return redirect()->route('login')->with('error', 'Register failed')->withInput();
        }
    }

    public function verifyGet()
    {
        $categories = $this->categoryService->getCategory();

        if (session()->has('token')) {
            return redirect()->intended('/');
        } else if (!session()->has('emailRegister')) {
            return redirect()->route('login')->with('error', 'You must register first');
        } else {
            return view('auth.verify-account')->with('categories', $categories);
        }
    }

    public function verifyPost(Request $request)
    {
        $email = session('emailRegister');
        $request->merge(['email' => $email]);

        $client = new Client();

        try {
            $response = $client->post($this->userService . 'auth/verify-account', [
                'json' => $request->all(),
            ]);

            $result = json_decode($response->getBody(), true);
            if (isset($result['message'])) {
                session()->forget('emailRegister');
                return redirect()->route('login')->with('message', 'Verify account successful. Login now');
            } else {
                return redirect()->route('verify-account')->with('error', 'Verify account failed');
            }
        } catch (\Exception|GuzzleException $e) {
            return redirect()->route('verify-account')->with('error', 'Verify account failed')->withInput();
        }
    }

    public function forgotPassword()
    {
        $categories = $this->categoryService->getCategory();

        if (session()->has('token')) {
            return redirect()->intended('/');
        }

        return view('auth.forgot-password')->with('categories', $categories);
    }

    public function postForgotPassword(Request $request)
    {
        $email = $request->email;

        $client = new Client();

        try{
            $response = $client->post($this->userService . 'auth/forgot-password', [
                'json' => $request->all(),
            ]);

            $result = json_decode($response->getBody(), true);
            if (isset($result['message'])) {
                session()->put('emailForgot', $email);
                return redirect()->route('inputOtp')->with('message', 'Please check your email');
            } else {
                return redirect()->route('forgotPassword')->with('error', 'Email does not exist')->withInput();
            }

        } catch (\Exception|GuzzleException $e) {
            return redirect()->route('forgotPassword')->with('error', 'Email does not exist');
        }
    }

    public function inputOtp()
    {
        $categories = $this->categoryService->getCategory();

        if (session()->has('token')) {
            return redirect()->intended('/');
        } else if (!session()->has('emailForgot')) {
            return redirect()->route('forgotPassword')->with('error', 'Please input email first');
        } else {
            return view('auth.verify-otp')->with('categories', $categories);
        }
    }

    public function postInputOtp(Request $request)
    {
        $client = new Client();
        $email = session('emailForgot');
        $request->merge(['email' => $email]);
        try {
            $response = $client->post($this->userService . 'auth/verify-otp', [
                'json' => $request->all(),
            ]);

            $result = json_decode($response->getBody(), true);

            if (isset($result['message'])) {
                session(['otpForgot' => $request->otp]);
                return redirect()->route('resetPassword')->with('message', 'OTP is correct');
            } else {
                return redirect()->route('inputOtp')->with('error', 'OTP is incorrect')->withInput();
            }

        } catch (\Exception|GuzzleException $e) {
            return redirect()->route('inputOtp')->with('error', 'OTP is incorrect');
        }
    }

    public function resetPassword()
    {
        $categories = $this->categoryService->getCategory();

        if (session()->has('token')) {
            return redirect()->intended('/');
        } else if (!session()->has('emailForgot') || !session()->has('otpForgot')) {
            return redirect()->route('forgotPassword')->with('error', 'Please input email first');
        } else {
            return view('auth.reset-password')->with('email', session('emailForgot'))->with('categories', $categories);
        }
    }

    public function postResetPassword(Request $request)
    {
        $email = session('emailForgot');
        $otp = session('otpForgot');

        $request->merge(['email' => $email]);
        $request->merge(['otp' => $otp]);

        $client = new Client();

        try {
            $response = $client->post($this->userService . 'auth/reset-password', [
                'json' => $request->all(),
            ]);

            $result = json_decode($response->getBody(), true);

            if (isset($result['message'])) {
                session()->forget('emailForgot');
                session()->forget('otpForgot');
                return redirect()->route('login')->with('message', 'Reset password successful');
            } else {
                return redirect()->route('resetPassword')->with('error', 'Reset password failed')->withInput();
            }

        } catch (\Exception|GuzzleException $e) {
            return redirect()->route('resetPassword')->with('error', 'Reset password failed');
        }
    }

    public function postProfile(Request $request, $id)
    {
        $token = session('token');
        $request->merge(['token' => $token]);

        $client = new Client();

        if ($request->hasFile('image')) {
            try{
                $imageFile = $request->file('image');
                $imageContents = file_get_contents($imageFile->getPathname());
                $imageExtension = $request->file('image')->getClientOriginalExtension();
                $base64Image = base64_encode($imageContents);
                $data['cover_image'] = $base64Image;
                $data['image_extension'] = $imageExtension;
            } catch (\Exception|GuzzleException $e) {

                return redirect()->route('profile')->with('error', 'Update profile failed');
            }
        } else {
            $data['cover_image'] = null;
            $data['image_extension'] = null;
        }

        $request->merge(['data' => $data]);
        try {
            $client->post($this->userService . 'auth/profile' . $id, [
                'json' => $request->all(),
            ]);

           return redirect()->route('profile')->with('message', 'Update profile successful');
        } catch (\Exception|GuzzleException $e) {
            return redirect()->route('profile')->with('error', 'Update profile failed');
        }
    }

}
