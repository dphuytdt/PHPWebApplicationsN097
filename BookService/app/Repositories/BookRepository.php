<?php

namespace App\Repositories;

use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;
use App\Models\Author;
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
    public function getBookByAuthor($author_id)
    {
        return Book::where('author_id', $author_id)->get();
    }

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

    //get book featured
    public function getFeaturedBooks()
    {
        return Book::where('is_featured', 1)->orderBy('updated_at', 'desc')->take(4)->get();
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
}