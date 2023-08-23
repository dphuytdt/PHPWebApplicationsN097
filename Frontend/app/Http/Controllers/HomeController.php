<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise;
use Illuminate\Support\Facades\Http;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Config;
use React\Http\Browser;
use GuzzleHttp\Promise\Utils;
use Illuminate\Pagination\Paginator;
use App\Services\HttpService;

class HomeController extends Controller
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

    public function index(Request $request){
        $httpService = app(HttpService::class);
        $client = $httpService->getClient();

        try {
            $req1 = $client->get($this->bookService .'books/homepage', ['timeout' => 60]);
            $books = json_decode($req1->getBody(), true);
            $req2 = $client->get($this->bookService . 'category');
            $categories = json_decode($req2->getBody(), true);
            return view('main.home.index')->with('books', $books)->with('categories', $categories);
        } catch (\Exception $e) {
            return view('errors.404')->with('categories', $categories);
        }
    }

    public function about()
    {
        $categories = $this->categoryService->getCategory();
        return view('main.home.about')->with('categories', $categories);
    }

    public function contact()
    {
        $categories = $this->categoryService->getCategory();
        return view('main.home.contact')->with('categories', $categories);
    }

    public function handleError()
    {
        $categories = $this->categoryService->getCategory();
        return view('errors.404')->with('categories', $categories);
    }

    private function getLatestNews()
    {
        $httpService = app(HttpService::class);
        $client = $httpService->getClient();
        try {
            $response = $client->get($this->contentService.'news/latest', ['timeout' => 60]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function thankYou()
    {
        $categories = $this->categoryService->getCategory();
        return view('main.cart.thankYou')->with('categories', $categories);
    }

}
