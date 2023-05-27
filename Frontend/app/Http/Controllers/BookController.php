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
}
