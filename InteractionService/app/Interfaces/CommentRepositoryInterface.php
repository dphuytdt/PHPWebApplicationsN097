<?php

namespace App\Interfaces;

interface CommentRepositoryInterface
{
    public function getComments($target_id, $type);

    public function store($data);

    public function delete($target_id, $comment_id, $type);

    public function deleteReply($target_id, $comment_id, $type);

    public function update($id, $target_id, $content, $updated_at, $type);

    public function getAllComment($type);
}
