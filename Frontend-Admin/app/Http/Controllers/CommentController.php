<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public $bookService = 'http://bookservice.test:8080/api/';
    public function index()
    {
        $client = new Client();
        try {
            $response = $client->get($this->bookService.'admin/comments');
            $paginator = json_decode($response->getBody(), true);
            return view('home.comment.list', compact('paginator'));
        } catch (\Exception $e) {
            return view('home.comment.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }
}
