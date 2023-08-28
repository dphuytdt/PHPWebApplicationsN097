<?php

namespace App\Repository;

use App\Models\Comment;

class CommentRepository
{
    public function addComment($data)
    {
        return Comment::create($data);
    }

    public function getAllComment($id)
    {
        return Comment::where('book_id', $id)->get();
    }
}
