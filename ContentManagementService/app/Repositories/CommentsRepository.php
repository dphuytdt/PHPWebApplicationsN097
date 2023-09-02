<?php

namespace App\Repositories;

use App\Interfaces\CommentsRepositoryInterfaces;
use App\Models\Comment;

class CommentsRepository implements CommentsRepositoryInterfaces
{
    public function getComments($id)
    {
        return Comment::where('news_id', $id)->orderBy('created_at', 'asc')->get();
    }

    public function store($data)
    {
        return Comment::create($data);
    }

    public function delete($news_id, $comment_id)
    {
        return Comment::where('news_id', $news_id)->where('id', $comment_id)->delete();
    }

    public function deleteReply($news_id, $comment_id)
    {
        return Comment::where('news_id', $news_id)->where('comment_parent_id', $comment_id)->delete();
    }

    public function update($id, $news_id, $content)
    {
        return Comment::where('id', $id)->where('news_id', $news_id)->update(['content' => $content]);
    }
}
