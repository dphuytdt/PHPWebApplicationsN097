<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use GuzzleHttp\Exception\GuzzleException;
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

        $client = new Client();

        $userId = session()->get('user')['id'];

        try{
            $req = $client->get($this->bookService . 'category');
            $categories = json_decode($req->getBody(), true);

            $req1 = $client->post($this->userService . 'auth/user-detail/' . $userId);
            $user = json_decode($req1->getBody(), true);

            $req2 = $client->get($this->paymentService . 'order-history/' . $userId);
            $orderHistory = json_decode($req2->getBody(), true);

            return view('main.user.profile')->with('categories', $categories)->with('user', $user)->with('orderHistory', $orderHistory['orderHistory']);
        } catch (\Exception|\Throwable|GuzzleException $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function postProfile(Request $request) {
        if ($request->hasFile('avatar')) {
            $imageFile = $request->file('avatar');
            $imagePath = Cloudinary::upload($imageFile->getRealPath())->getSecurePath();
        }

        $data = [
            'gender' => $request->gender ?? '',
            'fullname' => $request->fullname ?? '',
            'birthday' => $request->birthday ?? '',
            'address' => $request->address ?? '',
            'phone' => $request->phone ?? '',
            'avatar' => $imagePath ?? null,
        ];
        $client = new Client();

        try {
            $client->post($this->userService.'auth/update-profile/'.session()->get('user')['id'], [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('token'),
                ],
                'form_params' => $data
            ]);

            return redirect()->back()->with('success', 'Update profile successfully!');

        } catch (\Exception|\Throwable|GuzzleException $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function upgrade()
    {
        if (!session()->has('token')) {
            return redirect()->route('login');
        }

        $client = new Client();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

        return view('main.user.upgrade')->with('categories', $categories);
    }

    public function vipBenefits()
    {
        if (!session()->has('token')) {
            return redirect()->route('login');
        }

        $client = new Client();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

        return view('main.user.vip-benefits')->with('categories', $categories);
    }

    public function changePassword($id, Request $request) {
        $data = [
            'oldpassword' => $request->oldpassword ?? '',
            'password' => $request->password ?? '',
        ];

        $client = new Client();

        try {
            $client->post($this->userService.'auth/change-pass/'.$id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('token'),
                ],
                'form_params' => $data
            ]);

            return redirect()->back()->with('success', 'Change password successfully!');

        } catch (\Exception|\Throwable|GuzzleException $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
