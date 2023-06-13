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
            // Kiểm tra kết quả từ UserService
            if (isset($result['access_token'])) {
                // Lưu token vào session
                session()->put('token', $result['access_token']);
                //push user info to session
                session()->put('user', $user);
                //push role info to session
                session()->put('role', $user['role']);

                // Đăng nhập thành công, chuyển hướng đến trang home
                return redirect()->route('home');
            } else {
                // Đăng nhập thất bại, chuyển hướng đến trang đăng nhập
                return redirect()->route('login')->with('error', 'Invalid credentials');
            }
        } catch (\Exception $e) {
            // Lỗi xảy ra hoặc đăng nhập thất bại
            return redirect()->route('login')->with('error', 'Login failed');
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

    // public function register()
    // {
    //     // Kiểm tra xem người dùng đã đăng nhập hay chưa
    //     if (session()->has('token')) {
    //         // Người dùng đã đăng nhập, chuyển hướng đến trang home
    //         return redirect()->intended('/');
    //     }

    //     // Hiển thị trang đăng ký
    //     $provicce = new Province();
    //     // dd($provicce->getAll());
    //     $data['provinces'] = $provicce->getAll();
    //     return view('auth.register')->with('data', $data);
    // }

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
                return redirect()->route('login')->with('message', 'Register successful');
            } else {
                // Đăng ký thất bại, chuyển hướng đến trang đăng ký
                return redirect()->route('login')->with('error', 'Register failed');
            }

        } catch (\Exception $e) {
            // Lỗi xảy ra hoặc đăng ký thất bại
            return redirect()->route('register')->with('error', 'Register failed');
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
                return redirect()->route('forgotPassword')->with('error', 'Email does not exist');
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
                return redirect()->route('inputOtp')->with('error', 'OTP is incorrect');
            }

        } catch (\Exception $e) {
            // Lỗi xảy ra hoặc nhập mã OTP thất bại
            return redirect()->route('inputOtp')->with('error', 'OTP is incorrect');
        }
    }

    public function chooseDistrict(Request $request){
        $data = $request->all();
        $district = new District();
        $data['districts'] = $district->getDistrictByProvinceId($data['province_id']);
        //delete session
        //Session::forget('data');
        return response()->json($data);
    }

    public function chooseWard(Request $request){
        $data = $request->all();
        $ward = new Ward();
        $data['wards'] = $ward->getWardByDistrictId($data['district_id']);
        return response()->json($data);
    }

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
}
