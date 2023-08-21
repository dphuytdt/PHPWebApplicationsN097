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

    public function profile(Request $request)
    {
        if (!session()->has('token')) {
            return redirect()->route('login');
        }

        $categories = $this->categoryService->getCategory();

        return view('main.user.profile')->with('categories', $categories);
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
        if (!session()->has('token')) {
            return redirect()->route('login');
        }

        $categories = $this->categoryService->getCategory();

        return view('main.user.upgrade')->with('categories', $categories);
    }

    public function vipBenefits()
    {
        if (!session()->has('token')) {
            return redirect()->route('login');
        }

        $categories = $this->categoryService->getCategory();

        return view('main.user.vip-benefits')->with('categories', $categories);
    }
}
