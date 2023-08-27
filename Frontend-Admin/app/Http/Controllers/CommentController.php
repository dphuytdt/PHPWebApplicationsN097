<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

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
            $response = $client->get($this->bookService.'admin/comments');
            $paginator = json_decode($response->getBody(), true);

            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' view comment list' );
            return view('home.comment.list', compact('paginator'));
        } catch (\Exception $e) {
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot view comment list' );
            return view('home.comment.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }
}
