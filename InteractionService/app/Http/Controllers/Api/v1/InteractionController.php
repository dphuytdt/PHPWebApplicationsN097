<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth:api');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $token = $request->header('Authorization');

        // Kiểm tra xác thực token
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $client = new Client();
        try {
            $response = $client->request('GET', 'http://userservice.test:8080/api/auth/user-profile', [
                'headers' => [
                    'Authorization' => $token,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = json_decode($response->getBody()->getContents());
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'message' => 'success',
            'data' => [
                'user' => $user,
            ],
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
