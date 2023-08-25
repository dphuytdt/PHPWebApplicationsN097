<?php

namespace App\Interfaces;

interface BookRepositoryInterface
{
    public function getAllBooks();

    public function getBookById($id);

    public function getBookFree();

    public function getBookPaid();

    // public function getBookByAuthor($author_id);

    public function getBookByCategory($category_id);

    public function updateBook($id, $data);

    public function deleteBook($id);

    public function searchBook($keyword);

    public function createBook($data);

    public function updateBookById($id, $data);

    public function deleteBookById($id);

    public function readBook($id);

    public function getFreeBook();

    public function getAllBooksForAdmin();

    public function getHomepageBooks();

    public function getAllCategories();

    public function viewMore($dataType);

    public function getRelatedBooks($category_id, $id);
}
