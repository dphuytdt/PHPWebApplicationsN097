<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\OTPRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

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
                $result = $this->userRepository->upgradeUser($user, $request->amount);
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

    public function getAllUser() {
        $users = $this->userRepository->getAllUser();
        return response()->json(['users' => $users]);
    }

    public function userDetail(Request $request) {
        $user_detail = $this->userRepository->getUserDetail($request->user_id);
        if($user_detail) {
            return response()->json(['user_detail' => $user_detail]);
        } else {
            return response()->json(['message' => 'User not found']);
        }
    }

    public function importUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $file = $request->file('file');
        try {
            Excel::import(new UsersImport, $file);
            return response()->json(['message' => 'Import user successfully']);
        } catch (\Exception|\Error $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
