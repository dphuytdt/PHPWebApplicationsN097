<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface 
{
    public function getCommentByBookId(string $id)
    {
        $comments = Comment::where('book_id', $id)->get();
        return $comments;
    }

    public function getAllComment()
    {
        $comments = Comment::all();
        return $comments;
    }
}