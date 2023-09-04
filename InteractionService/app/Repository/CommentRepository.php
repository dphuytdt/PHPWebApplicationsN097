<?php

namespace App\Repository;

use App\Models\Comment;
use \App\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    public function getComments($target_id, $type)
    {
        return Comment::where('target_id', $target_id)->where('type', $type)->orderBy('created_at', 'asc')->get();
    }

    public function store($data)
    {
        return Comment::create($data);
    }

    public function delete($target_id, $comment_id, $type)
    {
        return Comment::where('target_id', $target_id)->where('id', $comment_id)->where('type', $type)->delete();
    }

    public function deleteReply($target_id, $comment_id, $type)
    {
        return Comment::where('target_id', $target_id)->where('comment_parent_id', $comment_id)->where('type', $type)->delete();
    }

    public function update($id, $target_id, $content, $updated_at, $type)
    {
        return Comment::where('id', $id)->where('target_id', $target_id)->where('type', $type)->update(['content' => $content, 'updated_at' => $updated_at]);
    }

    public function getAllComment($type)
    {
        return Comment::where('type', $type)->orderBy('created_at', 'asc')->get();
    }
}
