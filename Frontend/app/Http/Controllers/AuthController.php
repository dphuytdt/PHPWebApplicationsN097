<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Services\CategoryService;

class AuthController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function login()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (session()->has('token')) {
            // Người dùng đã đăng nhập, chuyển hướng đến trang home
            return redirect()->intended('/');
        }

        $categories = $this->categoryService->getCategory();

        // Hiển thị trang đăng nhập
        return view('auth.login')->with('categories', $categories);
    }

    public function postLogin(Request $request)
    {
        $client = new Client();

        try {
            // Gửi yêu cầu đăng nhập từ Home service tới UserService
            $response = $client->post('http://userservice.test:8080/api/auth/login', [
                'json' => $request->all(),
            ]);

            $result = json_decode($response->getBody(), true);
            $user = $result['user'];
            if (isset($result['access_token'])) {
                // Lưu token vào session
                session()->put('token', $result['access_token']);
                //push user info to session
                session()->put('user', $user);
                //push user id to session
                session()->put('user_id', $user['id']);
                //push role info to session
                session()->put('role', $user['role']);
                return redirect()->intended('/');
            } else {
                // Đăng nhập thất bại, chuyển hướng đến trang đăng nhập
                return redirect()->route('login')->with('error', 'Invalid credentials')->withInput();
            }
        } catch (\Exception $e) {
            // Lỗi xảy ra hoặc đăng nhập thất bại
            if ($e->getCode() == 400) {
                return redirect()->route('login')->with('error', 'You must verify email before login')->withInput();
            } else {
                return redirect()->route('login')->with('error', 'Wrong email or password')->withInput();
            }
        }
    }

    public function logout(Request $request)
    {
        $client = new Client();

        try {
            // Gửi yêu cầu logout từ Home service tới UserService
            $response = $client->post('http://userservice.test:8080/api/auth/logout', [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('token'), // Truyền token từ session
                ],
            ]);

            // Xóa token khỏi session
            session()->forget('token');
            session()->forget('user');
            session()->forget('role');

            // Chuyển hướng đến trang đăng nhập
            return redirect()->intended('/')->with('message', 'Logout successful');
        } catch (\Exception $e) {
            // Lỗi xảy ra hoặc logout thất bại
            return redirect()->intended('/')->with('error', 'Logout failed');
        }
    }


    public function postRegister(Request $request)
    {
        $client = new Client();

        try {
            // Gửi yêu cầu đăng ký từ Home service tới UserService
            $response = $client->post('http://userservice.test:8080/api/auth/register', [
                'json' => $request->all(),
            ]);

            $result = json_decode($response->getBody(), true);
            if (isset($result['message'])) {
                // Đăng ký thành công, chuyển hướng đến trang đăng nhập
                session()->put('emailRegister', $request->email);
                return redirect()->route('login')->with('message', 'Register successful. Check your email to verify account');
            } else {
                // Đăng ký thất bại, chuyển hướng đến trang đăng ký
                return redirect()->route('login')->with('error', 'Register failed');
            }

        } catch (\Exception $e) {
            // Lỗi xảy ra hoặc đăng ký thất bại
            return redirect()->route('login')->with('error', 'Register failed')->withInput();
        }
    }

    public function verifyGet(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $categories = $this->categoryService->getCategory();
        if (session()->has('token')) {
            // Người dùng đã đăng nhập, chuyển hướng đến trang home
            return redirect()->intended('/');
        } else if (!session()->has('emailRegister')) {
            // Người dùng chưa nhập email, chuyển hướng đến trang quên mật khẩu
            return redirect()->route('login')->with('error', 'You must register first');
        } else {
            return view('auth.verify-account')->with('categories', $categories);
        }
    }

    public function verifyPost(Request $request)
    {
        $client = new Client();
        $email = session('emailRegister');
        $request->merge(['email' => $email]);
        try {
            // Gửi yêu cầu xác thực tài khoản từ Home service tới UserService
            $response = $client->post('http://userservice.test:8080/api/auth/verify-account', [
                'json' => $request->all(),
            ]);

            $result = json_decode($response->getBody(), true);
            if (isset($result['message'])) {
                // Xác thực thành công, chuyển hướng đến trang đăng nhập
                session()->forget('emailRegister');
                return redirect()->route('login')->with('message', 'Verify account successful. Login now');
            } else {
                // Xác thực thất bại, chuyển hướng đến trang xác thực
                return redirect()->route('verify-account')->with('error', 'Verify account failed');
            }

        } catch (\Exception $e) {
            // Lỗi xảy ra hoặc xác thực thất bại
            return redirect()->route('verify-account')->with('error', 'Verify account failed')->withInput();
        }
    }

    public function forgotPassword()
    {
        $categories = $this->categoryService->getCategory();
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (session()->has('token')) {
            // Người dùng đã đăng nhập, chuyển hướng đến trang home
            return redirect()->intended('/');
        }

        // Hiển thị trang quên mật khẩu
        return view('auth.forgot-password')->with('categories', $categories);
    }

    public function postForgotPassword(Request $request)
    {
        $categories = $this->categoryService->getCategory();
        $userService = 'http://userservice.test:8080/api/auth';
        // $mailService = 'http://mailservice.test:8080/api';
        $email = $request->email;
        $client = new Client();
        try{
            // Gửi yêu cầu quên mật khẩu từ Home service tới UserService
            $response = $client->post($userService.'/forgot-password', [
                'json' => $request->all(),
            ]);

            $result = json_decode($response->getBody(), true);
            if (isset($result['message'])) {
                // Đăng ký thành công, chuyển hướng đến trang đăng nhập
                session()->put('emailForgot', $email);
                return redirect()->route('inputOtp')->with('message', 'Please check your email');
            } else {
                // Đăng ký thất bại, chuyển hướng đến trang đăng ký
                return redirect()->route('forgotPassword')->with('error', 'Email does not exist')->withInput();
            }

        } catch (\Exception $e) {
            // Lỗi xảy ra hoặc đăng ký thất bại
            return redirect()->route('forgotPassword')->with('error', 'Email does not exist');
        }
    }

    public function inputOtp()
    {
        $categories = $this->categoryService->getCategory();
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (session()->has('token')) {
            // Người dùng đã đăng nhập, chuyển hướng đến trang home
            return redirect()->intended('/');
        } else if (!session()->has('emailForgot')) {
            // Người dùng chưa nhập email, chuyển hướng đến trang quên mật khẩu
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
            // Gửi yêu cầu nhập mã OTP từ Home service tới UserService
            $response = $client->post('http://userservice.test:8080/api/auth/verify-otp', [
                'json' => $request->all(),
            ]);

            $result = json_decode($response->getBody(), true);

            //check status code
            if (isset($result['message'])) {
                // Nhập mã OTP thành công, chuyển hướng đến trang đổi mật khẩu
                session(['otpForgot' => $request->otp]);
                return redirect()->route('resetPassword')->with('message', 'OTP is correct');
            } else {
                // Nhập mã OTP thất bại, chuyển hướng đến trang nhập mã OTP
                return redirect()->route('inputOtp')->with('error', 'OTP is incorrect')->withInput();
            }

        } catch (\Exception $e) {
            // Lỗi xảy ra hoặc nhập mã OTP thất bại
            return redirect()->route('inputOtp')->with('error', 'OTP is incorrect');
        }
    }

    // public function chooseDistrict(Request $request){
    //     $data = $request->all();
    //     $district = new District();
    //     $data['districts'] = $district->getDistrictByProvinceId($data['province_id']);
    //     //delete session
    //     //Session::forget('data');
    //     return response()->json($data);
    // }

    // public function chooseWard(Request $request){
    //     $data = $request->all();
    //     $ward = new Ward();
    //     $data['wards'] = $ward->getWardByDistrictId($data['district_id']);
    //     return response()->json($data);
    // }

    public function resetPassword()
    {
        $categories = $this->categoryService->getCategory();
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (session()->has('token')) {
            // Người dùng đã đăng nhập, chuyển hướng đến trang home
            return redirect()->intended('/');
        } else if (!session()->has('emailForgot') || !session()->has('otpForgot')) {
            // Người dùng chưa nhập email hoặc nhập mã OTP, chuyển hướng đến trang quên mật khẩu
            return redirect()->route('forgotPassword')->with('error', 'Please input email first');
        } else {
            return view('auth.reset-password')->with('email', session('emailForgot'))->with('categories', $categories);
        }
    }

    public function postResetPassword(Request $request)
    {
        $client = new Client();
        $email = session('emailForgot');
        $otp = session('otpForgot');
        $request->merge(['email' => $email]);
        $request->merge(['otp' => $otp]);
        try {
            // Gửi yêu cầu đổi mật khẩu từ Home service tới UserService
            $response = $client->post('http://userservice.test:8080/api/auth/reset-password', [
                'json' => $request->all(),
            ]);

            $result = json_decode($response->getBody(), true);

            //check status code
            if (isset($result['message'])) {
                // Đổi mật khẩu thành công, chuyển hướng đến trang đăng nhập
                session()->forget('emailForgot');
                session()->forget('otpForgot');
                return redirect()->route('login')->with('message', 'Reset password successful');
            } else {
                // Đổi mật khẩu thất bại, chuyển hướng đến trang đổi mật khẩu
                return redirect()->route('resetPassword')->with('error', 'Reset password failed')->withInput();
            }

        } catch (\Exception $e) {
            // Lỗi xảy ra hoặc đổi mật khẩu thất bại
            return redirect()->route('resetPassword')->with('error', 'Reset password failed');
        }
    }

}
