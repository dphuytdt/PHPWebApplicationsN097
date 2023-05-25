<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class HomeController extends Controller
{
    public function index(Request $request)
    {
        $client = new Client();

        try {
            // Gửi yêu cầu kiểm tra xác thực người dùng từ Home service tới UserService
            $response = $client->get('http://userservice.test:8080/api/auth/check-auth', [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('token'), // Truyền token từ session
                ],
            ]);

            $result = json_decode($response->getBody(), true);
            // Kiểm tra kết quả từ UserService
            if ($result['message'] === 'Authenticated') {
                // Người dùng đã đăng nhập
                return view('home');
            } else {
                // Người dùng chưa đăng nhập
                return redirect()->route('login');
            }
        } catch (\Exception $e) {
            // Lỗi xảy ra hoặc xác thực thất bại
            return redirect()->route('login');
        }
    }
}
