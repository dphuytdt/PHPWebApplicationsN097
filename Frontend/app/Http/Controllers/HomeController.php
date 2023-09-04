<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Services\CategoryService;
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

    /**
     * @throws GuzzleException
     */
    public function index(Request $request){
        $httpService = app(HttpService::class);
        $client = $httpService->getClient();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);
        try {
            $req1 = $client->get($this->bookService .'books/homepage');
            $books = json_decode($req1->getBody(), true);

            $req3 = $client->get($this->contentService . 'user/news/latest');
            $latestNews = json_decode($req3->getBody(), true);

            return view('main.home.index')->with('books', $books)->with('categories', $categories)->with('latestNews', $latestNews);
        } catch (\Exception|GuzzleException $e) {
            return view('errors.404')->with('categories', $categories);
        }
    }

    /**
     * @throws GuzzleException
     */
    public function about()
    {
        $httpService = app(HttpService::class);
        $client = $httpService->getClient();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);
        return view('main.home.about')->with('categories', $categories);
    }

    /**
     * @throws GuzzleException
     */
    public function contact()
    {
        $httpService = app(HttpService::class);
        $client = $httpService->getClient();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

        return view('main.home.contact')->with('categories', $categories);
    }

    /**
     * @throws GuzzleException
     */
    public function handleError()
    {
        $httpService = app(HttpService::class);
        $client = $httpService->getClient();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

        return view('errors.404')->with('categories', $categories);
    }

    /**
     * @param Client $client
     * @return void
     * @throws GuzzleException
     */
    public function extracted(Client $client): void
    {
        if (session()->has('user')) {
            $user = session('user');
            $req3 = $client->post($this->userService . 'auth/user-detail/' . $user['id']);
            $res = json_decode($req3->getBody(), true);
            $user['is_vip'] = $res['user']['is_vip'];
            session()->put('user', $user);
        }
    }

    /**
     * @throws GuzzleException
     */
    public function thankYou()
    {
        $httpService = app(HttpService::class);
        $client = $httpService->getClient();

        $req2 = $client->get($this->bookService . 'category');
        $this->extracted($client);
        $categories = json_decode($req2->getBody(), true);

        return view('main.cart.thankYou')->with('categories', $categories);
    }

    /**
     * @throws GuzzleException
     */
    public function faq()
    {
        $httpService = app(HttpService::class);
        $client = $httpService->getClient();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

        return view('main.home.faq')->with('categories', $categories);
    }
}
