<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class WishlistController extends Controller
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
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $categories = $this->categoryService->getCategory();

        $client = new Client();

        try{
            $response = $client->request('GET', $this->paymentService . 'wishlist/get/' . $id);
            $wishlists = json_decode($response->getBody()->getContents());
        } catch (\Exception|GuzzleException $e) {
            $wishlists = [];
        }

        return view('main.wishlist.index', compact('categories', 'wishlists'));
    }
}
