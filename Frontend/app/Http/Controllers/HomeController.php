<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Illuminate\Support\Facades\Http;
use App\Services\CategoryService;
class HomeController extends Controller
{
    public $bookService = 'http://bookservice.test:8080/api/';
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request){
        $client = new Client();
        //get categorieS
        $categories = $this->categoryService->getCategory();
        return view('main.home')->with('categories', $categories);
    }
    
    public function about()
    {
        $categories = $this->categoryService->getCategory();
        return view('main.about')->with('categories', $categories);
    }

    public function contact()
    {
        $categories = $this->categoryService->getCategory();
        return view('main.contact')->with('categories', $categories);
    }
}
