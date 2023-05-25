<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
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

            // Kiểm tra kết quả từ UserService
            if (isset($result['access_token'])) {
                // Lưu token vào session
                session(['token' => $result['access_token']]);

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
}
