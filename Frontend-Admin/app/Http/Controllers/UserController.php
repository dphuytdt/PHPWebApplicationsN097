<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $userService = 'http://userservice.test:8080/api/auth/';
    public function index()
    {
        $client = new Client();
        try {
            $response = $client->get($this->userService.'admin/user', [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('token'), // Truyền token từ session
                    "Accept"=>"application/json"
                ],

            ]);
            $users = json_decode($response->getBody(), true);
            $user_infor = $users['users'];
            return view('home.user.list', compact('users', 'user_infor'));
        } catch (\Exception $e) {
            dd($e);
            // return view('home.user.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('home.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $client = new Client();

        try {
            $client->post($this->userService.'admin/user', [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('token'),
                    "Accept"=>"application/json"
                ],
                'json' => [
                    'fullname' => $data['fullname'],
                    'email' => $data['email'],
                    'role' => $data['role'],
                ]
            ]);
            return view('home.user.create');
        } catch (\Exception $e) {
            return view('home.user.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = new Client();

        try {
            $req = $client->get($this->userService.'admin/user/'.$id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('token'), // Truyền token từ session
                    "Accept"=>"application/json"
                ],
            ]);

            $res = json_decode($req->getBody(), true);
            return view('home.user.edit', compact('res'));
        } catch (\Exception|GuzzleException $e) {
            return view('home.user.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $client = new Client();

        try {
            $req = $client->post($this->userService.'admin/user/'.$id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('token'), // Truyền token từ session
                    "Accept"=>"application/json"
                ],
                'json' => [
                    'fullname' => $data['fullname'],
                    'role' => $data['role'],
                    'is_active' => $data['is_active'],
                ]
            ]);

            $users = json_decode($req->getBody(), true);
            $user_infor = $users['users'];
            return view('home.user.list', compact('users', 'user_infor'));
        } catch (\Exception|GuzzleException $e) {
            return view('home.user.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteUser(string $id)
    {
        $client = new Client();

        try {
            $req = $client->post($this->userService.'admin/user/in-active/'.$id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('token'), // Truyền token từ session
                    "Accept"=>"application/json"
                ],
            ]);

            $res = json_decode($req->getBody(), true);
            return view('home.user.list', compact('res'));
        } catch (\Exception|GuzzleException $e) {
            return view('home.user.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    private function import(Request $request){
        $data = $request->all();
        $file = $data['file'];

        $client = new Client();

        try{
            $req = $client->post($this->userService.'admin/user/import', [
                'form-param' => [
                    'file' => $file,
                ],
            ]);

            return response()->json([
                'message' => 'Import success',
            ]);
        } catch (\Exception|GuzzleException $e) {
            return view('home.user.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }
}
