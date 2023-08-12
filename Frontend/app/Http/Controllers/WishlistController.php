<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class WishlistController extends Controller
{

//    public $bookService = 'http://bookservice.test:8080/api/';

        public const PAYMENT_SERVICE = 'http://paymentservice.test:8080/api/wishlist';
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;

    }
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $categories = $this->categoryService->getCategory();

        $client = new Client();

        try{
            $response = $client->request('GET', self::PAYMENT_SERVICE . '/get/' . $id);
            $wishlists = json_decode($response->getBody()->getContents());
        } catch (\Exception|GuzzleException $e) {
            $wishlists = [];
        }

        return view('main.wishlist.index', compact('categories', 'wishlists'));
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
        //
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
