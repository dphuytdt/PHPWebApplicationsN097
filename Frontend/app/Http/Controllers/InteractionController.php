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
                    'target_id' => $data['id'],
                    'type' => $data['type'],
                    'user_id' => $user['id'],
                    'comment_name' => $user['fullname'],
                    'rate' => $data['rate'] ?? null,
                    'content' => $data['comment'],
                ]
            ]);
            $responseData = json_decode($response->getBody(), true);
            if($responseData) {
                return $responseData;
            } else {
                return 1;
                return redirect()->back()->with('error', 'Review failed!');
            }
        } catch (\Exception|GuzzleException $e) {
            return $e;
            return redirect()->back()->with('error', 'Review failed!');
        }
    }

    public function replyReview(Request $request) {
        $data = $request->all();
        $client = new Client();
        $user = session()->get('user');

        try {
            $response = $client->post($this->interactionService.'comment/reply', [
                'form_params' => [
                    'comment_name' => $user['fullname'],
                    'content' => $data['comment'],
                    'target_id' => $data['id'],
                    'user_id' => $user['id'],
                    'type' => $data['type'],
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

    public function deleteReview(Request $request) {
        $data = $request->all();
        $client = new Client();

        try {
            $response = $client->post($this->interactionService.'comment/delete/', [
                'form_params' => [
                    'target_id' => $data['id'],
                    'comment_id' => $data['comment_id'],
                    'type' => $data['type'],
                ]
            ]);
            $responseData = json_decode($response->getBody(), true);
            if($responseData) {
                return $responseData;
            } else {
                return redirect()->back()->with('error', 'Delete failed!');
            }
        } catch (\Exception|GuzzleException $e) {
            return redirect()->back()->with('error', 'Delete failed!');
        }
    }

    public function updateReview(Request $request) {
        $data = $request->all();
        $client = new Client();
        try {
            $response = $client->put($this->interactionService.'comment/'.$data['comment_id'], [
                'form_params' => [
                    'target_id' => $data['id'],
                    'content' => $data['comment'],
                    'updated_at' => date('Y-m-d H:i:s'),
                    'type' => $data['type'],
                ]
            ]);
            $responseData = json_decode($response->getBody(), true);

            if($responseData) {
                return $responseData;
            } else {
                return redirect()->back()->with('error', 'Update failed!');
            }
        } catch (\Exception|GuzzleException $e) {
            return $e;
            return redirect()->back()->with('error', 'Update failed!');
        }
    }
}
