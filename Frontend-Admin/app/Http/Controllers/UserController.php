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
                    'fullname' => $data['fullname'] ?? '',
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
        $csvFile = $request->file('file');

        $file = Excel::toArray((object)[], $csvFile);

        if(count($file[0][0]) != 3){
            return redirect()->back()->with('error', 'File is not valid format with 3 columns');
        }

        if($file[0][0][0] != 'fullname' || $file[0][0][1] != 'email' || $file[0][0][2] != 'role'){
            return redirect()->back()->with('error', 'File is not valid. Column must be contain [fullname, email, role]');
        }

        foreach ($file[0] as $key => $value) {
            if($key == 0){
                continue;
            }
            if($value[2] != 'ROLE_USER' && $value[2] != 'ROLE_ADMIN'){
                return redirect()->back()->with('error', 'File is not valid. Role must be contain [ROLE_USER, ROLE_ADMIN]');
            }

            if(!filter_var($value[1], FILTER_VALIDATE_EMAIL)){
                return redirect()->back()->with('error', 'File is not valid. Email must be contain @');
            }
        }

        unset($file[0][0]);

        $client = new Client();
        dd($file[0]);
        try{
            $client->post($this->userService.'auth/admin/user/import', [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('adminToken'),
                ],
                'form-param' => [
                    'file' => $file[0],
                ],
            ]);

            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' import user successfully' );
            return redirect()->back()->with('success', 'Import user successfully');
        } catch (\Exception|GuzzleException $e) {
            dd($e);
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot import user' );
            return view('home.user.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function profile($userId){
        Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' view profile' );
        return view('home.self.profile');
    }

    public function getChangePassword($userId){
        Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' view change password' );
        return view('home.self.change-password');
    }

    public function changePassword($id, Request $request) {
        $data = [
            'password' => $request->password ?? '',
        ];

        $client = new Client();

        try {
            $client->post($this->userService.'auth/change-pass/'.$id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('adminToken'),
                ],
                'form_params' => $data
            ]);

            return redirect()->back()->with('success', 'Change password successfully!');

        } catch (\Exception|\Throwable|GuzzleException $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
