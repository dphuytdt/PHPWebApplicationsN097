<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
class HomeController extends Controller
{
    public $bookService = 'http://bookservice.test:8080/api/';
    public function index(Request $request){
        $client = new Client();
        try {
            $response = $client->get($this->bookService.'books/featured');
            $books_featured = json_decode($response->getBody(), true);
        } 
        catch (\Exception $e) {
            return redirect()->intended('/')->with('error', 'Error');
        }
        return view('main.home', compact('books_featured'));
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
