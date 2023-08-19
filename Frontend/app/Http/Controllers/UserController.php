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
    private const USER_SERVICE = 'http://userservice.test:8080/api/auth';

    private const PAYMENT_SERVICE = 'http://paymentservice.test:8080/api';

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function profile()
    {
        if (!session()->has('token')) {
            return redirect()->route('login');
        }

        $categories = $this->categoryService->getCategory();
        $user = session()->get('user');
        $user_id = $user['id'];

        $client = new Client();

        try {
            $response = $client->post(self::USER_SERVICE.'/user-detail/'.$user_id);

            $res = json_decode($response->getBody(), true);
            $userDetails = $res['user'];

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
