<?php

namespace App\Interfaces;

interface CommentRepositoryInterface
{
    public function getAllComment($id);

    public function addComment($data);

    public function getAllCommentForAdmin();

    public function getAllCommentReplyForAdmin();
}
