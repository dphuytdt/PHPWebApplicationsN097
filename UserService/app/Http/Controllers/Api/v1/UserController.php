<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Imports\UserImport;
use App\Jobs\AdminSendMailCreateUser;
use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\OTPRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;
    private OTPRepositoryInterface $otpRepository;

    public function __construct(UserRepositoryInterface $userRepository, OTPRepositoryInterface $otpRepository) {
        $this->middleware('auth:api', ['except' => ['userDetail']]);
        $this->userRepository = $userRepository;
        $this->otpRepository = $otpRepository;
    }

    public function upgrateUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'amount' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $email = $request->email;
        $user = $this->userRepository->getUserByemail($email);
        if($user) {
            if($user->is_vip == 1) {
                return response()->json(['message' => 'User is vip']);
            } else {
                $result = $this->userRepository->upgradeUser($user, $request->amount, $request->numberMonth);
                if($result) {
                    return response()->json(['message' => 'Upgrade user successfully']);
                } else {
                    return response()->json(['message' => 'Upgrade user failed']);
                }
            }
        } else{
            return response()->json(['message' => 'User not found']);
        }

    }

    public function getAllUser(): \Illuminate\Http\JsonResponse
    {
        $users = $this->userRepository->getAllUser();
        return response()->json(['users' => $users]);
    }

    public function userDetail(Request $request): \Illuminate\Http\JsonResponse
    {
        $user_detail = $this->userRepository->getUserDetail($request->user_id);
        if($user_detail) {
            return response()->json(['user_detail' => $user_detail]);
        } else {
            return response()->json(['message' => 'User not found']);
        }
    }

    public function importUser(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $file = $request->file('file');

        try {
            Excel::import(new UserImport, $file);
            return response()->json(['message' => 'Import user successfully']);
        } catch (\Exception|\Error $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse{
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:ROLE_USER,ROLE_ADMIN',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $passwordGenerate = $this->otpRepository->generatePassword();
        $password = Hash::make($passwordGenerate);
        $created_at = date('Y-m-d H:i:s');
        $is_active = 1;
        $request->merge(['password' => $password, 'created_at' => $created_at, 'is_active' => $is_active]);

        try {
            $user = $this->userRepository->createUser($request->all());

            if($user) {
                if(AdminSendMailCreateUser::dispatch($user->email, $passwordGenerate)) {
                    return response()->json(['message' => 'Create user successfully']);
                } else {
                    return response()->json(['message' => 'Create user failed']);
                }
            } else {
                return response()->json(['message' => 'Create user failed']);
            }
        } catch (\Exception|\Error|\Throwable $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $user = $this->userRepository->getUserById($id);
        if($user) {
            return response()->json(['user' => $user]);
        } else {
            return response()->json(['message' => 'User not found']);
        }
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'role' => 'required|in:ROLE_USER,ROLE_ADMIN',
            'is_active' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $this->userRepository->adminUpdateUser($request->all(), $id);
            $users = $this->userRepository->getAllUser();
            return response()->json(['users' => $users]);
        } catch (\Exception|\Error $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        try {
            $user = $this->userRepository->deleteUser($id);
            return response()->json(['message' => 'Delete user successfully']);
        } catch (\Exception|\Error $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function import(Request $request): \Illuminate\Http\JsonResponse
    {
        DB::beginTransaction();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
        } else {
            return response()->json(['message' => 'No file selected']);
        }

        try {
            $userImport = new UserImport();
            $userImport->import($file);
            DB::commit();

            foreach ($userImport->getUsers() as $user) {
                $passwordGenerate = $this->otpRepository->generatePassword();
                $password = Hash::make($passwordGenerate);
                $created_at = date('Y-m-d H:i:s');
                $is_active = 1;
                $user['password'] = $password;
                $user['created_at'] = $created_at;
                $user['is_active'] = $is_active;
                $user = $this->userRepository->createUser($user);
                if($user) {
                    $req = AdminSendMailCreateUser::dispatch($user->email, $passwordGenerate);
                } else {
                    return response()->json(['message' => 'Import user failed']);
                }
            }

            if($userImport->failures()->count() > 0 || !$req) {
                return response()->json(['message' => 'Import user failed']);
            } else {
                return response()->json(['message' => 'Import user successfully']);
            }

        } catch (\Exception|\Error|\Throwable $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
