<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Interfaces\CommentsRepositoryInterfaces;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private CommentsRepositoryInterfaces $commentsRepository;

    public function __construct(CommentsRepositoryInterfaces $commentsRepository)
    {
        $this->commentsRepository = $commentsRepository;
    }

    public function commentStore(Request $request) {
        $data = $request->all();

        try {
            $newComment = $this->commentsRepository->store($data);
            return response()->json($newComment, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Comment created failed'
            ], 500);
        }
    }

    public function replyComment(Request $request) {
        $data = $request->all();

        try {
            $newComment = $this->commentsRepository->store($data);
            return response()->json($newComment, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Comment created failed'
            ], 500);
        }
    }

    public function commentDelete(Request $request) {
        $data = $request->all();
        try {
            $comment = $this->commentsRepository->delete($data['news_id'], $data['comment_id']);
            if ($data['is_reply']) {
                $commentReply = $this->commentsRepository->deleteReply($data['news_id'], $data['comment_id']);
            }

            return response()->json($comment + $commentReply, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Comment delete failed'
            ], 500);
        }
    }

    public function commentUpdate(Request $request, $id) {
        $data = $request->all();
        try {
            $updated_at = now();
            $comment = $this->commentsRepository->update($id, $data['news_id'], $data['content'], $updated_at);
            return response()->json($comment, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Comment update failed'
            ], 500);
        }
    }
}
