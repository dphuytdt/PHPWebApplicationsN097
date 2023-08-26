<?php

namespace App\Repositories;

use App\Interfaces\CommentsRepositoryInterfaces;
use App\Models\Comment;

class CommentsRepository implements CommentsRepositoryInterfaces
{
    public function getComments($id)
    {
        return Comment::where('news_id', $id)->get();
    }
}
