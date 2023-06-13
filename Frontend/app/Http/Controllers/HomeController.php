<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Illuminate\Support\Facades\Http;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Config;
use React\Http\Browser;
use GuzzleHttp\Promise\Utils;
use Illuminate\Pagination\Paginator;

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
        $client = new Client();
        $categories = $this->categoryService->getCategory();
        $response = $client->get($this->bookService.'books/is_free');
        $books = json_decode($response->getBody(), true);
        // $paginatedBooks = new Paginator($books, 5);
        // $paginatedBooks->withPath('/');
        return view('main.home.index')->with('books', $books)->with('categories', $categories);
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

    //custom 404 page
    public function handleError()
    {
        $categories = $this->categoryService->getCategory();
        return view('errors.404')->with('categories', $categories);
    }


}
