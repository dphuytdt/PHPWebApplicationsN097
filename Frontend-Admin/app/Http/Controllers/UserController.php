<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
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
            $response = $client->get($this->userService.'auth/admin/user', [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('adminToken'),
                    "Accept"=>"application/json"
                ],

            ]);
            $users = json_decode($response->getBody(), true);
            $user_infor = $users['users'];
            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' view user list' );

            return view('home.user.list', compact('users', 'user_infor'));
        } catch (\Exception $e) {
            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' cannot view user list' );

            return view('home.user.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function create()
    {
        Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' view create user' );
        return view('home.user.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $client = new Client();

        try {
            $client->post($this->userService.'auth/admin/user', [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('adminToken'),
                    "Accept"=>"application/json"
                ],
                'json' => [
                    'fullname' => $data['fullname'],
                    'email' => $data['email'],
                    'role' => $data['role'],
                ]
            ]);

            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' create user successfully' );

            return view('home.user.create');
        } catch (\Exception|GuzzleException $e) {
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot create user' );

            return view('home.user.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function show(string $id)
    {
        $client = new Client();

        try {
            $req = $client->get($this->userService.'auth/admin/user/'.$id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('adminToken'), // Truyền token từ session
                    "Accept"=>"application/json"
                ],
            ]);

            $res = json_decode($req->getBody(), true);

            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' view user' );

            return view('home.user.edit', compact('res'));
        } catch (\Exception|GuzzleException $e) {
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot view user' );
            return view('home.user.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $client = new Client();

        try {
            $req = $client->post($this->userService.'auth/admin/user/'.$id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('adminToken'),
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
            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' update user successfully' );

            return view('home.user.list', compact('users', 'user_infor'));
        } catch (\Exception|GuzzleException $e) {
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot update user' );
            return view('home.user.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function deleteUser(string $id)
    {
        $client = new Client();

        try {
            $req = $client->post($this->userService.'auth/admin/user/in-active/'.$id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('adminToken'),
                    "Accept"=>"application/json"
                ],
            ]);

            $res = json_decode($req->getBody(), true);
            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' delete user successfully' );
            return view('home.user.list', compact('res'));
        } catch (\Exception|GuzzleException $e) {
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot delete user' );
            return view('home.user.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function import(Request $request){
        $data = $request->all();
        $file = $data['file'];

        $client = new Client();

        try{
            $client->post($this->userService.'auth/admin/user/import', [
                'form-param' => [
                    'file' => $file,
                ],
            ]);

            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' import user successfully' );
            return response()->json([
                'message' => 'Import success',
            ]);
        } catch (\Exception|GuzzleException $e) {
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot import user' );
            return view('home.user.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function profile($userId){
        Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' view profile' );
        return view('home.self.profile');
    }
}
