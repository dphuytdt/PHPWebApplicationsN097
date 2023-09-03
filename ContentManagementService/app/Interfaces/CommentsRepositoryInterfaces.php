<?php

namespace App\Interfaces;

interface CommentsRepositoryInterfaces
{
    public function getComments($id);

    public function store($data);

    public function delete($news_id, $comment_id);

    public function deleteReply($news_id, $comment_id);

    public function update($id, $news_id, $content, $updated_at);

    public function getAllComments();

    public function getAllCommentReply();
}
