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
            $req1 = $client->get($this->bookService .'books/homepage');
            $books = json_decode($req1->getBody(), true);

            $req2 = $client->get($this->bookService . 'category');
            $categories = json_decode($req2->getBody(), true);

            $req3 = $client->get($this->contentService . 'user/news/latest');
            $latestNews = json_decode($req3->getBody(), true);

            return view('main.home.index')->with('books', $books)->with('categories', $categories)->with('latestNews', $latestNews);
        } catch (\Exception $e) {
            $categories = [];
            return view('errors.404')->with('categories', $categories);
        }
    }

    public function about()
    {
        $httpService = app(HttpService::class);
        $client = $httpService->getClient();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);
        return view('main.home.about')->with('categories', $categories);
    }

    public function contact()
    {
        $httpService = app(HttpService::class);
        $client = $httpService->getClient();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

        return view('main.home.contact')->with('categories', $categories);
    }

    public function handleError()
    {
        $httpService = app(HttpService::class);
        $client = $httpService->getClient();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

        return view('errors.404')->with('categories', $categories);
    }

    private function getLatestNews()
    {
        $httpService = app(HttpService::class);
        $client = $httpService->getClient();

        try {
            $response = $client->get($this->contentService.'news/latest', ['timeout' => 60]);

            $req2 = $client->get($this->bookService . 'category');
            $categories = json_decode($req2->getBody(), true);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function thankYou()
    {
        $httpService = app(HttpService::class);
        $client = $httpService->getClient();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);
        return view('main.cart.thankYou')->with('categories', $categories);
    }

    public function faq()
    {
        $httpService = app(HttpService::class);
        $client = $httpService->getClient();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);
        return view('main.home.faq')->with('categories', $categories);
    }

}
