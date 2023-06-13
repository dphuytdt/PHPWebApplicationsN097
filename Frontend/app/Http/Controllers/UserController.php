<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;

class UserController extends Controller
{
    protected $categoryService;

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

        // Hiển thị trang profile
        return view('main.user.profile')->with('categories', $categories);
    }
}
