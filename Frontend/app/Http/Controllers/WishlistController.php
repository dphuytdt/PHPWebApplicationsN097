<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
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
}
