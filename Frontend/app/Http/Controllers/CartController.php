<?php

namespace App\Http\Controllers;


use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use GuzzleHttp\Client;

class CartController extends Controller
{
    public $bookService = 'http://bookservice.test:8080/api/';
    public $paymentService = 'http://paymentservice.test:8080/api/';
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function getUserCart($id)
    {
        if (!session()->has('token')) {
            // Người dùng chưa đăng nhập, chuyển hướng đến trang login
            return redirect()->route('login');
        }
        $categories = $this->categoryService->getCategory();
        $client = new Client();
        try {
            $response = $client->get($this->paymentService.'cart/get/'.$id);
            $response = json_decode($response->getBody()->getContents());
            $cart = $response->result;
            return view('main.cart.index', compact('categories', 'cart'));
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        } catch (GuzzleException $e) {
            return response()->json($e->getMessage());
        }
    }

    public function addToCart(Request $request)
    {
        $client = new Client();
        try {
            $response = $client->post($this->paymentService.'cart/add', [
                'form_params' => [
                    "userID" => $request->userID,
                    "bookID" => $request->bookID,
                    "bookTitle" => $request->bookTitle,
                    "bookPrice" => $request->bookPrice,
                    "bookImage" => $request->bookImage
                ]
            ]);
            $response = json_decode($response->getBody()->getContents());
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        } catch (GuzzleException $e) {
            return response()->json($e->getMessage());
        }
    }

    public function checkout()
    {
        $categories = $this->categoryService->getCategory();
        return view('main.cart.checkout', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
