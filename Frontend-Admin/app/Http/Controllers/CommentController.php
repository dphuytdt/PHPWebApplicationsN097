<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    protected $bookService, $contentService, $userService, $paymentService, $interactionService;

    public function __construct()
    {
        $this->bookService = env('BOOK_SERVICE_HOST', null);
        $this->contentService = env('CONTENT_MANAGEMENT_SERVICE_HOST', null);
        $this->userService = env('USER_SERVICE_HOST', null);
        $this->paymentService = env('PAYMENT_SERVICE_HOST', null);
        $this->interactionService = env('INTERACTION_SERVICE_HOST', null);
    }

    public function index()
    {
        $client = new Client();

        try {
            $response = $client->get($this->contentService . 'admin/comment', [
                'headers' => [
                    'Authorization' => session('token_type') . ' ' . session('access_token')
                ]
            ]);
            $newsComment = json_decode($response->getBody(), true);

            $req = $client->get($this->interactionService . 'comment/admin/manage-comments', [
                'headers' => [
                    'Authorization' => session('token_type') . ' ' . session('access_token')
                ]
            ]);

            $booksComment = json_decode($req->getBody(), true);
            $result = [
                'newsComment' => $newsComment['comments'],
                'newsRepply' => $newsComment['comment_reply'],
                'booksComment' => $booksComment['comments'],
                'booksRepply' => $booksComment['replyComment'],
            ];

            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' view comment list' );

            return view('home.comment.list', compact('result'));
        } catch (\Exception|GuzzleException $e) {
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot view comment list' );

            return view('home.comment.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function reply(Request $request) {
        $data = $request->all();
        $user = session()->get('admin');
        $reply = [
            'comment_name' => $user['fullname'],
            'content' => $data['content'],
            'user_id' => $user['id'],
            'comment_parent_id' => $data['comment_parent_id'],
            'news_id' => $data['news_id'],
        ];

        try {
            $client = new Client();
            $response = $client->post($this->contentService . 'comment/reply', [
                'headers' => [
                    'Authorization' => session('token_type') . ' ' . session('access_token')
                ],
                'form_params' => $reply
            ]);
            $response = json_decode($response->getBody(), true);
            return $response;
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function delete(Request $request) {
        $data = $request->all();
        try {
            $client = new Client();
            $response = $client->post($this->contentService . 'comment/delete', [
                'headers' => [
                    'Authorization' => session('token_type') . ' ' . session('access_token')
                ],
                'form_params' => $data
            ]);
            $response = json_decode($response->getBody(), true);
            return $response;
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
