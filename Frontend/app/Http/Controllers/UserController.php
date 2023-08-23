<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use GuzzleHttp\Client;
use App\Services\HttpService;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
