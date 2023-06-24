<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\BookRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\CommentRepositoryInterface;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
class BookController extends Controller
{
    protected BookRepositoryInterface $bookRepository;
    protected CategoryRepositoryInterface $categoryRepository;
    protected CommentRepositoryInterface $commentRepository;
    public function __construct(BookRepositoryInterface $bookRepository, CategoryRepositoryInterface $categoryRepository, CommentRepositoryInterface $commentRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->categoryRepository = $categoryRepository;
        $this->commentRepository = $commentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentPage = $request->query('page', 1);
        $perPage = $request->query('perPage', 10);
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
        
        $books = Book::paginate($perPage);
        
        return response()->json($books);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = $this->bookRepository->getBookById($id);
        $comments = $this->commentRepository->getCommentByBookId($id);
        $result = [
            'book' => $book,
            'comments' => $comments
        ];
        return response()->json($result, 200);
    }

    //search book
    public function search(string $keyword, Request $request)
    {
        $books = Book::where('title', 'like', "%{$keyword}%")
            ->orWhere('description', 'like', "%{$keyword}%")
            ->orWhere('content', 'like', "%{$keyword}%")
            ->orWhere('price', 'like', "%{$keyword}%")
            // ->orWhere('discount', 'like', "%{$keyword}%")
            ->orWhere('quantity', 'like', "%{$keyword}%")
            ->orWhere('status', 'like', "%{$keyword}%")
            ->orWhere('is_featured', 'like', "%{$keyword}%")
            ->orWhere('author', 'like', "%{$keyword}%")
            ->orWhereHas('category', function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            })->paginate(8);
        return response()->json($books);
    }

    public function getFeaturedBooks()
    {
        $books = $this->bookRepository->getFeaturedBooks();
        // dd($books);
        // dd('abc');
        return response()->json($books, 200);
    }

    public function getCategory()
    {
        $categories = $this->categoryRepository->getAllCategory();
        return response()->json($categories, 200);
    }

    public function getCategoryForAdmin()
    {
        $categories = $this->categoryRepository->getAllCategoryForAdmin();
        return response()->json($categories, 200);
    }

    //get category
    public function getSelectedCategory()
    {
        $categories = $this->categoryRepository->getSelectedCategory();
        return response()->json($categories, 200);
    }

    //read book
    public function readBook(string $id)
    {
        $book = $this->bookRepository->readBook($id);
        return response()->json($book, 200);
    }

    //get free book
    public function getFreeBook()
    {
        $books = $this->bookRepository->getFreeBook();
        return response()->json($books, 200);
    }

    public function getNewBooks()
    {
        $books = $this->bookRepository->getNewBooks();
        return response()->json($books, 200);
    }

}
