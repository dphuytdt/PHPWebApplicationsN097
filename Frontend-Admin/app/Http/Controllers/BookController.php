<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Spatie\PdfToText\Pdf;

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
        if ($request->hasFile('image')) {
            try{
                $imageFile = $request->file('image');
                $imageContents = file_get_contents($imageFile->getPathname());
                $imageExtension = $request->file('image')->getClientOriginalExtension();
                $base64Image = base64_encode($imageContents);
            } catch (\Exception $e) {
                return redirect()->route('books.index')->withErrors(['errors' => 'Cannot read file']);
            }
        }

        if ($request->hasFile('content')) {
            try{
                $contentFile = $request->file('content');
                $contentContents = file_get_contents($contentFile->getPathname());
                $base64Content = base64_encode($contentContents);
            } catch (\Exception $e) {
                return redirect()->route('books.index')->withErrors(['errors' => 'Cannot read file']);
            }

        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'discount' => $request->discount,
            'content' => $base64Content ?? '',
            'status' => $request->status,
            'image' => $base64Image ?? '',
            'image_extension' => $imageExtension ?? '',
        ];

        $client = new Client();

        try{
            $client->post($this->bookService.'admin/books', [
                'form_params' => [
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'author' => $data['author'],
                    'category_id' => $data['category_id'],
                    'price' => $data['price'],
                    'discount' => $data['discount'],
                    'contentPdf' => $data['content'],
                    'status' => $data['status'],
                    'image' => $data['image'],
                    'image_extension' => $data['image_extension'],
                ]
            ]);

            return redirect()->route('books.index')->with('success', 'Create book successfully');
        } catch (\Exception|GuzzleException $e) {
            return redirect()->route('books.index')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = new Client();
        try {
            $response = $client->get($this->bookService.'admin/books/'.$id);
            $res= json_decode($response->getBody(), true);
            $book = $res['book'];
            $categories = $res['categories'];
            return view('home.book.edit', compact('book', 'categories'));
        } catch (\Exception $e) {
            return view('home.book.edit')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->hasFile('image')) {
            try{
                $imageFile = $request->file('image');
                $imageContents = file_get_contents($imageFile->getPathname());
                $imageExtension = $request->file('image')->getClientOriginalExtension();
                $base64Image = base64_encode($imageContents);
                $data['cover_image'] = $base64Image;
                $data['image_extension'] = $imageExtension;
            } catch (\Exception $e) {

                return redirect()->route('books.index')->withErrors(['errors' => 'Cannot read file']);
            }
        } else {
            $data['cover_image'] = null;
            $data['image_extension'] = null;
        }

        if ($request->hasFile('content')) {
            try{
                $contentFile = $request->file('content');
                $contentContents = file_get_contents($contentFile->getPathname());
                $base64Content = base64_encode($contentContents);
                $data['content'] = $base64Content;
            } catch (\Exception $e) {

                return redirect()->route('books.index')->withErrors(['errors' => 'Cannot read file']);
            }

        } else {
            $data['content'] = null;
        }

        $client = new Client();

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'discount' => $request->discount,
            'content' => $base64Content ?? '',
            'status' => $request->status,
            'cover_image' => $base64Image ?? '',
            'image_extension' => $imageExtension ?? '',
        ];

        try{
            $client->post($this->bookService.'admin/books/'.$id, [
                'form_params' => [
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'author' => $data['author'],
                    'category_id' => $data['category_id'],
                    'price' => $data['price'],
                    'discount' => $data['discount'],
                    'contentPdf' => $data['content'],
                    'status' => $data['status'],
                    'cover_image' => $data['cover_image'],
                    'image_extension' => $data['image_extension'],
                ]
            ]);

            return redirect()->route('books.index')->with('success', 'Update book successfully');
        } catch (\Exception|GuzzleException $e) {
            return redirect()->route('books.index')->withErrors(['errors' => 'Cannot connect to server']);
        }
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
