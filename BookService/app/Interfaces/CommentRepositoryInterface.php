<?php

namespace App\Interfaces;

interface CommentRepositoryInterface 
{
    public function getCommentByBookId(string $id);
}