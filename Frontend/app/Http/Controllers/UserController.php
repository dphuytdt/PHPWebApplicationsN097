<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use GuzzleHttp\Client;
use App\Services\HttpService;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $categoryService;
    public $userService = 'http://userservice.test:8080/api/auth';
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function profile()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (!session()->has('token')) {
            // Người dùng chưa đăng nhập, chuyển hướng đến trang login
            return redirect()->route('login');
        }

        $categories = $this->categoryService->getCategory();
        $user = session()->get('user');
        $user_id = $user['id'];
        $client = new Client();
        try {
            $response = $client->post($this->userService.'/user-detail', [
                'timeout' => 60,
                'headers' => [
                    // 'Authorization' => 'Bearer ' . session('token'),
                    "Accept"=>"application/json"
                ],
                'json' => [
                    'user_id' => $user_id
                ]
            ]);
            $userDetails = json_decode($response->getBody(), true);
            // dd($userDetails);
            return view('main.user.profile')->with('categories', $categories)->with('user', $user)
                    ->with('userDetails', $userDetails);
        } catch (\Exception $e) {
            return view('errors.404')->with('categories', $categories);
        }

    }

    public function postProfile(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|numeric',
            'birthday' => 'required|date',
            'address' => 'required',
        ]);
    }

    public function upgrade()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (!session()->has('token')) {
            // Người dùng chưa đăng nhập, chuyển hướng đến trang login
            return redirect()->route('login');
        }

        $categories = $this->categoryService->getCategory();

        // Hiển thị trang upgrade
        return view('main.user.upgrade')->with('categories', $categories);
    }

    public function vipBenefits()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (!session()->has('token')) {
            // Người dùng chưa đăng nhập, chuyển hướng đến trang login
            return redirect()->route('login');
        }

        $categories = $this->categoryService->getCategory();

        // Hiển thị trang upgrade
        return view('main.user.vip-benefits')->with('categories', $categories);
    }
}
