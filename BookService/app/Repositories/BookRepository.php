<?php

namespace App\Repositories;

use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;
use App\Models\Category;

class BookRepository implements BookRepositoryInterface
{
    //get all books
    public function getAllBooks()
    {
        return Book::all();
    }

    //get book by id
    public function getBookById($id)
    {
        return Book::find($id);
    }

    //get book free
    public function getBookFree()
    {
        return Book::where('is_free', 1)->get();
    }

    //get book paid
    public function getBookPaid()
    {
        return Book::where('is_free', 0)->get();
    }

    //get book by author
    // public function getBookByAuthor($author_id)
    // {
    //     return Book::where('author', $author_id)->get();
    // }

    //get book by category
    public function getBookByCategory($category_id)
    {
        return Book::where('category_id', $category_id)->get();
    }

    //update book
    public function updateBook($id, $data)
    {
        return Book::find($id)->update($data);
    }

    //delete book
    public function deleteBook($id)
    {
        return Book::find($id)->delete();
    }

    //search book
    public function searchBook($keyword)
    {
        $query = Book::query();
        $query->where('title', 'LIKE', '%' . $keyword . '%');
        $query->orWhere('description', 'LIKE', '%' . $keyword . '%');
        $query->orWhere('content', 'LIKE', '%' . $keyword . '%');
        return $query->get();
    }
    //insertBook
    public function createBook($data)
    {
        return Book::create($data);
    }

    //updateBook
    public function updateBookById($id, $data)
    {
        return Book::find($id)->update($data);
    }

    //deleteBook
    public function deleteBookById($id)
    {
        return Book::find($id)->update(['deleted_at' => now()]);
    }

    //readBook
    public function readBook($id)
    {
        $result = Book::find($id);
    }

    //get free book
    public function getFreeBook()
    {
        return Book::where('price', 0)->get();
    }


    //get book for admin
    public function getAllBooksForAdmin()
    {
        $books = Book::all();
        foreach ($books as $book) {
            $book->category_name = Category::find($book->category_id)->name;
        }
        return $books;
    }

    //get homepage book
    public function getHomepageBooks()
    {
        $books = [];
        $books['free'] = Book::where('price', 0)->orderBy('created_at', 'desc')->get();
        $books['featured'] = Book::where('is_featured', 1)->orderBy('updated_at', 'desc')->get();
        $books['new'] = Book::where('created_at', '>=', now()->subDays(7))->orWhere('updated_at', '>=', now()->subDays(7))->get();
        if (count($books['new']) == 0) {
            $books['new'] = Book::orderBy('updated_at', 'desc')->take(10)->get();
        }
        return $books;
    }
}
