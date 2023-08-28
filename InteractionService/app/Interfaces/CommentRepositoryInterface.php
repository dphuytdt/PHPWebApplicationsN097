<?php

namespace App\Interfaces;

interface CommentRepositoryInterface
{
    public function getAllComment($id);

    public function addComment($data);
}
