<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class HomeController extends Controller
{
    public $bookService = 'http://bookservice.test:8080/api/';
    public function index()
    {
        $client = new Client();
        try {
            $response = $client->get($this->bookService . 'books');
            $books = json_decode($response->getBody(), true);
            //paginate books
            $paginate = 5;
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $offSet = ($page * $paginate) - $paginate;
            $itemsForCurrentPage = array_slice($books, $offSet, $paginate, true);
            $books = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($books), $paginate, $page);
            $books->setPath(request()->url());
            return view('main.home', compact('books'));
        } 
        catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Login failed');
        }
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
