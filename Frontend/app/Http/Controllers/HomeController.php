<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
class HomeController extends Controller
{
    public $bookService = 'http://bookservice.test:8080/api/';
    public function index(Request $request){

        return view('main.home');
    }
    
    public function about()
    {
        return view('main.about');
    }

    public function contact()
    {
        return view('main.contact');
    }
}
