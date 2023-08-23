<?php

namespace App\Repositories;

use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;
use App\Models\Category;

class BookRepository implements BookRepositoryInterface
{
    public function getAllBooks()
    {
        return Book::all();
    }

    public function getBookById($id)
    {
        return Book::find($id);
    }

    public function getBookFree()
    {
        return Book::where('is_free', 1)->get();
    }

    public function getBookPaid()
    {
        return Book::where('is_free', 0)->get();
    }

    public function getBookByCategory($category_id)
    {
        return Book::where('category_id', $category_id)->paginate(8);
    }

    public function updateBook($id, $data)
    {
        $book = Book::find($id);
        if (is_null($book)) {
            return false;
        }

        if (isset($data['cover_image']) && ($data['cover_image']  !== $book->cover_image)) {
            $book->cover_image = $data['cover_image'];
            $book->image_extension = $data['image_extension'];
        }

        if (isset($data['title']) && ($data['title']  !== $book->title)) {
            $book->title = $data['title'];
        }

        if (isset($data['description']) && ($data['description']  !== $book->description)) {
            $book->description = $data['description'];
        }

        if (isset($data['author']) && ($data['author']  !== $book->author)) {
            $book->author = $data['author'];
        }

        if (isset($data['category_id']) && ($data['category_id']  !== $book->category_id)) {
            $book->category_id = $data['category_id'];
        }

        if (isset($data['content']) && ($data['content']  !== $book->content)) {
            $book->content = $data['content'];
        }

        if (isset($data['price']) && ($data['price']  !== $book->price)) {
            $book->price = $data['price'];
        }

        if (isset($data['discount']) && ($data['discount']  !== $book->discount)) {
            $book->discount = $data['discount'];
        }

        if (isset($data['content']) && ($data['content']  !== $book->content)) {
            $book->content = $data['content'];
        }

        if (isset($data['cover_image']) && ($data['cover_image']  !== $book->cover_image)) {
            $book->cover_image = $data['cover_image'];
            $book->image_extension = $data['image_extension'];
        }

        if (isset($data['is_vip_valid']) && ($data['is_vip_valid']  !== $book->is_vip_valid)) {
            $book->is_vip_valid = $data['is_vip_valid'];
        }

        return $book->save();
    }

    public function deleteBook($id)
    {
        return Book::find($id)->delete();
    }

    public function searchBook($keyword)
    {
        $query = Book::query();
        $query->where('title', 'LIKE', '%' . $keyword . '%');
        $query->orWhere('description', 'LIKE', '%' . $keyword . '%');
        $query->orWhere('content', 'LIKE', '%' . $keyword . '%');
        return $query->get();
    }

    public function createBook($data)
    {
        return Book::create($data);
    }

    public function updateBookById($id, $data)
    {
        return Book::find($id)->update($data);
    }

    public function deleteBookById($id)
    {
        return Book::find($id)->update(['deleted_at' => now()]);
    }

    public function readBook($id)
    {
        $result = Book::find($id);
    }

    public function getFreeBook()
    {
        return Book::where('price', 0)->get();
    }

    public function getAllBooksForAdmin()
    {
        $books = Book::all();
        foreach ($books as $book) {
            $book->category_name = Category::find($book->category_id)->name;
        }
        return $books;
    }

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

    public function getAllCategories()
    {
        return Category::all();
    }

    public function viewMore($dataType)
    {
        $dataType = strtolower($dataType);

        if ($dataType == 'free') {
            return Book::where('price', 0)->orderBy('created_at', 'desc')->paginate(8);
        } else if ($dataType == 'featured') {
            return Book::where('is_featured', 1)->orderBy('updated_at', 'desc')->paginate(8);
        } else if ($dataType == 'new') {
            $news = Book::where('created_at', '>=', now()->subDays(7))
                ->orWhere('updated_at', '>=', now()->subDays(7))
                ->paginate(8);
            if (count($news) == 0) {
                return Book::orderBy('created_at', 'desc')->paginate(8);
            }
            return $news;
        } else {
            return Book::orderBy('updated_at', 'desc')->paginate(8);
        }
    }
}
