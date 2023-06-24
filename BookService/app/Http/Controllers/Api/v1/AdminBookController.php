<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\BookRepositoryInterface;
use Illuminate\Support\Facades\Validator;
class AdminBookController extends Controller
{
    protected BookRepositoryInterface $bookRepository;
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = $this->bookRepository->getAllBooksForAdmin();
        dd($books);
        //bug here
        return response()->json($books, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'author_id' => 'required|integer',
            'category_id' => 'required|integer',
            'price' => 'required|integer',
            'is_free' => 'required|boolean',
            'cover' => 'required|string',
            'file' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $book = $this->bookRepository->createBook($request->all());
        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = $this->bookRepository->getBookById($id);
        if (is_null($book)) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [$request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'author_id' => 'required|integer',
            'category_id' => 'required|integer',
            'price' => 'required|integer',
            'is_free' => 'required|boolean',
            'cover' => 'required|string',
            'file' => 'required|string',
        ]]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $book = $this->bookRepository->updateBook($id, $request->all());
        return response()->json($book, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        //find book by id
        $book = $this->bookRepository->getBookById($id);
        if (is_null($book)) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        //delete book
        $this->bookRepository->deleteBookById($id);
        return response()->json(null, 204);
    }
}
