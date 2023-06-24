<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public $bookService = 'http://bookservice.test:8080/api/';
    public function index()
    {
        $client = new Client();
        try {
            $response = $client->get($this->bookService.'admin/books');
            $paginator = json_decode($response->getBody(), true);
            return view('home.book.list', compact('paginator'));
        } catch (\Exception $e) {
            dd($e);
            // return view('home.category.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $client = new Client();
        try {
            $response = $client->get($this->bookService.'category/admin');
            $categories = json_decode($response->getBody(), true);
            return view('home.book.create', compact('categories'));
        } catch (\Exception $e) {
            return view('home.book.create')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('home.book.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function delete(string $id)
    {
        $client = new Client();
        try {
            $response = $client->delete($this->bookService.'admin/books/'.$id);
            $result = json_decode($response->getBody(), true);
            if ($result['status'] == 200) {
                return redirect()->route('books.index')->with('success', 'Delete book successfully');
            } else {
                return redirect()->route('books.index')->withErrors(['errors' => 'Cannot delete book']);
            }
        } catch (\Exception $e) {
            return redirect()->route('books.index')->withErrors(['errors' => 'Cannot connect to server']);
        }

    }
}
