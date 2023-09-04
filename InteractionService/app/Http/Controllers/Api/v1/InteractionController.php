<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Interfaces\CommentRepositoryInterface;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    private CommentRepositoryInterface $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function commentStore(Request $request) {
        $data = $request->all();

        try {
            $newComment = $this->commentRepository->store($data);
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
            $newComment = $this->commentRepository->store($data);
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
            $comment = $this->commentRepository->delete($data['target_id'], $data['comment_id'], $data['type']);

            $commentReply = $this->commentRepository->deleteReply($data['target_id'], $data['comment_id'], $data['type']);

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
            $comment = $this->commentRepository->update($id, $data['target_id'], $data['content'], $data['updated_at'], $data['type']);
            return response()->json($comment, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Comment update failed'
            ], 500);
        }
    }

    public function getComment($target_id, $type) {
        try {
            $comments = $this->commentRepository->getComments($target_id, $type);
            $commentFilter = [];
            for ($i = 0; $i < count($comments); $i++) {
                $commentFilter[$comments[$i]['comment_parent_id'] ?? $comments[$i]['id']][] = $comments[$i];
            }
            return response()->json($commentFilter, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function manageComments() {
        try {
            $booksComment = $this->commentRepository->getAllComment(1);

            $booksCommentFilter = [];
            for ($i = 0; $i < count($booksComment); $i++) {
                $booksCommentFilter[$booksComment[$i]['comment_parent_id'] ?? $booksComment[$i]['id']][] = $booksComment[$i];
            }

            return response()->json([
                'booksComment' => $booksCommentFilter
            ], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
