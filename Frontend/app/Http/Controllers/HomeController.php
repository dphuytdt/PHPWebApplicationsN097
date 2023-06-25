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
    // //CALL TO ENVIRONMENT VARIABLE TO GET BOOK SERVICE URL
    public $bookService = 'http://bookservice.test:8080/api/';
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request){
        $categories = $this->categoryService->getCategory();
        $httpService = app(HttpService::class);
        $client = $httpService->getClient();
        try {
            $response1 = $client->get($this->bookService.'books/homepage', ['timeout' => 60]);
            $books = json_decode($response1->getBody(), true);
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


}
