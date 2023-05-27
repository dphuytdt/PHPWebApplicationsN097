<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class BookController extends Controller
{
    public $bookService = 'http://bookservice.test:8080/api/';
    
    public function show($id)
    {
        $client = new Client();
        //call to book service to get book by id
        try {
            $response = $client->get($this->bookService.'books/'.$id);
            $book = json_decode($response->getBody(), true);
            return view('books.book-details', compact('book'));
        } 
        catch (\Exception $e) {
            return redirect()->intended('/')->with('error', 'Login failed');
        }
    }

    public function search(Request $request)
    {
        $client = new Client();
        //call to book service to get book by id
        try {
            $response = $client->get($this->bookService.'books/search/'.$request->keyword);
            $books = json_decode($response->getBody(), true);
            //paginate books
            if($books){
                $paginate = 5;
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $offSet = ($page * $paginate) - $paginate;
                $itemsForCurrentPage = array_slice($books, $offSet, $paginate, true);
                $books = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($books), $paginate, $page);
                $books->setPath(request()->url());
                return view('books.search-result', compact('books'));
            }
            else{
                return redirect()->intended('/')->with('error', 'No result');
            }
        } 
        catch (\Exception $e) {
            return redirect()->intended('/')->with('error', 'Error');
        }
    }
}
