<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
class AuthController extends Controller
{
    public function login()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (session()->has('token')) {
            // Người dùng đã đăng nhập, chuyển hướng đến trang home
            return redirect()->intended('/');
        }

        // Hiển thị trang đăng nhập
        return view('auth.login');
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
                session(['token' => $result['access_token']]);
                //push user info to session
                session(['user' => $result['user']]);
                //push role info to session
                session(['role' => $user['role']]);

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

            // Chuyển hướng đến trang đăng nhập
            return redirect()->route('login')->with('message', 'Logout successful');
        } catch (\Exception $e) {
            // Lỗi xảy ra hoặc logout thất bại
            return redirect()->route('login')->with('error', 'Logout failed');
        }
    }

    public function register()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (session()->has('token')) {
            // Người dùng đã đăng nhập, chuyển hướng đến trang home
            return redirect()->intended('/');
        }

        // Hiển thị trang đăng ký
        $provicce = new Province();
        // dd($provicce->getAll());
        $data['provinces'] = $provicce->getAll();
        return view('auth.register')->with('data', $data);
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
                return redirect()->route('login')->with('message', 'Register successful');
            } else {
                // Đăng ký thất bại, chuyển hướng đến trang đăng ký
                return redirect()->route('register')->with('error', 'Register failed');
            }

        } catch (\Exception $e) {
            // Lỗi xảy ra hoặc đăng ký thất bại
            return redirect()->route('register')->with('error', 'Register failed');
        }
    }

    public function forgotPassword()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (session()->has('token')) {
            // Người dùng đã đăng nhập, chuyển hướng đến trang home
            return redirect()->intended('/');
        }

        // Hiển thị trang quên mật khẩu
        return view('auth.forgot-password');
    }

    public function postForgotPassword(Request $request)
    {
        $userService = 'http://userservice.test:8080/api/auth';
        // $mailService = 'http://mailservice.test:8080/api';
        $email = $request->email;
        $client = new Client();
        $response = $client->post($userService . '/forgot-password', [
            'json' => $request->only('email'),
        ]);
        if ($response->getStatusCode() == 200) {
            return redirect()->route('inputOtp')->with('message', 'Please check your email to get OTP');
        }
        return redirect()->back()->with('error', 'Send OTP failed');
        // dd($response->getStatusCode());
        //$result = json_decode($response->getBody(), true);
        // if ($response->getStatusCode() == 200) {
        //     $response = $client->post($mailService . '/sendOTP', [
        //         'json' => [
        //             'email' => $result['user']['email'],
        //             'name' => $result['user']['name'],
        //             // 'subject' => 'Reset password',
        //         ],
        //     ]);
        //     $result = json_decode($response->getBody(), true);
        //     // dd($result);
        //     if ($response->getStatusCode() == 200) {
        //         return redirect()->route('inputOtp')->with('message', 'Please check your email to get OTP');
        //     }
        //     return redirect()->back()->with('error', 'Send OTP failed');
        // }
        // return redirect()->back()->with('error', 'Email does not exist');
    }

    public function inputOtp()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (session()->has('token')) {
            // Người dùng đã đăng nhập, chuyển hướng đến trang home
            return redirect()->intended('/');
        }

        // Hiển thị trang nhập mã OTP
        return view('auth.verify-otp');
    }

    public function postInputOtp(Request $request)
    {
        $client = new Client();

        try {
            // Gửi yêu cầu nhập mã OTP từ Home service tới UserService
            $response = $client->post('http://userservice.test:8080/api/auth/verify-otp', [
                'json' => $request->all(),
            ]);

            $result = json_decode($response->getBody(), true);
            
            //check status code
            if ($response->getStatusCode() == 200) {
                // Nhập mã OTP thành công, chuyển hướng đến trang đổi mật khẩu
                return redirect()->route('changePassword')->with('message', 'OTP is correct');
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

    // public function adminLogin()
    // {
    //     // Kiểm tra xem người dùng đã đăng nhập hay chưa
    //     if (session()->has('token') && session()->get('role') == 0) {
    //         // Người dùng đã đăng nhập, chuyển hướng đến trang home
    //         return redirect()->intended('/');
    //     }

    //     // Hiển thị trang đăng nhập
    //     return view('auth.admin-login');
    // }

    // public function postAdminLogin(Request $request)
    // {
    //     $client = new Client();

    //     try {
    //         // Gửi yêu cầu đăng nhập từ Home service tới UserService
    //         $response = $client->post('http://userservice.test:8080/api/auth/login', [
    //             'json' => $request->all(),
    //         ]);

    //         $result = json_decode($response->getBody(), true);
    //         if (isset($result['message'])) {
    //             // Đăng nhập thành công, chuyển hướng đến trang home
    //             session()->put('token', $result['token']);
    //             session()->put('role', $result['user']['role']);
    //             session()->put('user_id', $result['user']['id']);
    //             return redirect()->intended('/');
    //         } else {
    //             // Đăng nhập thất bại, chuyển hướng đến trang đăng nhập
    //             return redirect()->route('adminLogin')->with('error', 'Login failed');
    //         }

    //     } catch (\Exception $e) {
    //         // Lỗi xảy ra hoặc đăng nhập thất bại
    //         return redirect()->route('adminLogin')->with('error', 'Login failed');
    //     }
    // }
}
