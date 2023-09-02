<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Repository\CommentRepository;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    private CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function show(string $id)
    {
        try {
            $comment = $this->commentRepository->getAllComment($id);
            $commentFilter = [];
            for ($i = 0; $i < count($comment); $i++) {
                $commentFilter[$comment[$i]['comment_parent_id'] ?? $comment[$i]['id']][] = $comment[$i];
            }
            return response()->json($commentFilter, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function comment(Request $request) {
        $data = $request->all();
        $newComment = [
            'comment_name' => $data['comment_name'],
            'content' => $data['content'],
            'rate' => $data['rate'],
            'book_id' => $data['book_id'],
            'user_id' => $data['user_id'],
        ];
        try {
            $comment = $this->commentRepository->addComment($newComment);
            return response()->json($comment, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function reply(Request $request) {
        $data = $request->all();
        $reply = [
            'comment_name' => $data['comment_name'],
            'content' => $data['content'],
            'book_id' => $data['book_id'],
            'user_id' => $data['user_id'],
            'comment_parent_id' => $data['comment_parent_id'],
        ];

        try {
            $comment = $this->commentRepository->addComment($reply);
            return response()->json($comment, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function manageComments()
    {
        try {
            $comments = $this->commentRepository->getAllCommentForAdmin();
            return response()->json($comments, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
