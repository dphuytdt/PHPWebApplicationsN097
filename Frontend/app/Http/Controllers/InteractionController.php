<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    private $interactionService;

    public function __construct()
    {
        $this->interactionService = env('INTERACTION_SERVICE_HOST', null);
    }

    public function review(Request $request) {
        $data = $request->all();
        $client = new Client();
        $user = session()->get('user');
        try {
            $response = $client->post($this->interactionService.'comment', [
                'form_params' => [
                    'book_id' => $data['book_id'],
                    'user_id' => $user['id'],
                    'comment_name' => $user['fullname'],
                    'rate' => $data['rate'],
                    'content' => $data['comment'],
                ]
            ]);
            $responseData = json_decode($response->getBody(), true);
            if($responseData) {
                return $responseData;
            } else {
                return redirect()->back()->with('error', 'Review failed!');
            }
        } catch (\Exception|GuzzleException $e) {
            return redirect()->back()->with('error', 'Review failed!');
        }
    }

    public function replyReview(Request $request) {
        $data = $request->all();
        $client = new Client();
        $user = session()->get('user');
        try {
            $response = $client->post($this->interactionService.'reply', [
                'form_params' => [
                    'comment_name' => $user['fullname'],
                    'content' => $data['comment'],
                    'book_id' => $data['book_id'],
                    'user_id' => $user['id'],
                    'comment_parent_id' => $data['parent_id'],
                ]
            ]);
            $responseData = json_decode($response->getBody(), true);
            if($responseData) {
                return $responseData;
            } else {
                return view('errors.404')->with('categories', $responseData);
            }
        } catch (\Exception|GuzzleException $e) {
            return view('errors.404')->with('categories', $responseData);
        }
    }
}
