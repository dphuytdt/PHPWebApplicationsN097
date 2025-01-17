<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\BookRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Spatie\PdfToText\Pdf;
use Illuminate\Support\Facades\Storage;
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
        return response()->json($books, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $created_at = now();

        $data = [
            'title' => $request->title,
            'description' => $request->description ?? '',
            'author' => $request->author,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'discount' => $request->discount,
            'cover_image' => $request->image,
            'content' => $request->contentPdf,
            'status' => $request->status,
            'is_vip_valid' => $request->is_vip_valid,
            'is_featured' => $request->is_featured,
            'created_at' => $created_at,
            'image_extension' => $request->image_extension,
        ];

        try{
            $book = $this->bookRepository->createBook($data);
            return response()->json($book, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = $this->bookRepository->getBookById($id);
        $categories = $this->bookRepository->getAllCategories();
        if (is_null($book)) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json([
            'book' => $book,
            'categories' => $categories
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'discount' => $request->discount,
            'content' => $request->contentPdf,
            'cover_image' => $request->cover_image,
            'image_extension' => 'png',
            'is_vip_valid' => $request->is_vip_valid,
            'is_featured' => $request->is_featured,
            'status' => $request->status,
        ];

        try{
            $book = $this->bookRepository->updateBook($id, $data);

            return response()->json($book, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $book = $this->bookRepository->getBookById($id);
        if (is_null($book)) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $this->bookRepository->deleteBookById($id);
        return response()->json(null, 204);
    }
}
