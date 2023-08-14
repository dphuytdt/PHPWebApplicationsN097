<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\BookRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\CommentRepositoryInterface;
use App\Models\Book;
use Illuminate\Pagination\Paginator;

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

    public function search(string $keyword, Request $request)
    {
        $books = Book::where('title', 'like', "%{$keyword}%")
            ->orWhere('description', 'like', "%{$keyword}%")
            ->orWhere('content', 'like', "%{$keyword}%")
            ->orWhere('price', 'like', "%{$keyword}%")
            ->orWhere('status', 'like', "%{$keyword}%")
            ->orWhere('is_featured', 'like', "%{$keyword}%")
            ->orWhere('author', 'like', "%{$keyword}%")
            ->orWhereHas('category', function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            })->paginate(8);

        return response()->json($books);
    }

    public function readBook(string $id)
    {
        $book = $this->bookRepository->readBook($id);
        return response()->json($book, 200);
    }

    public function getFreeBook()
    {
        $books = $this->bookRepository->getFreeBook();
        return response()->json($books, 200);
    }

    public function getHomepageBooks()
    {
        $books = $this->bookRepository->getHomepageBooks();
        return response()->json($books, 200);
    }

    public function viewMore(string $dataType)
    {
        $books = $this->bookRepository->viewMore($dataType);
        return response()->json($books, 200);
    }

    public function getBookByCategory(string $id)
    {
        $books = $this->bookRepository->getBookByCategory($id);
        return response()->json($books, 200);
    }

}
