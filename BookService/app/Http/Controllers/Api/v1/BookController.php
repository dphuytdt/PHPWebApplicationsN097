<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\BookRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
class BookController extends Controller
{
    protected BookRepositoryInterface $bookRepository;
    protected CategoryRepositoryInterface $categoryRepository;
    public function __construct(BookRepositoryInterface $bookRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->categoryRepository = $categoryRepository;

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
        return response()->json($book, 200);
    }

    //search book
    public function search(string $keyword)
    {
        $books = $this->bookRepository->searchBook($keyword);
        return response()->json($books, 200);
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

    //get category
    public function getSelectedCategory()
    {
        $categories = $this->categoryRepository->getSelectedCategory();
        return response()->json($categories, 200);
    }

}
