<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\OTPRepositoryInterface;
class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;
    private OTPRepositoryInterface $otpRepository;
    public function __construct(UserRepositoryInterface $userRepository, OTPRepositoryInterface $otpRepository) {
        $this->middleware('auth:api');
        $this->userRepository = $userRepository;
        $this->otpRepository = $otpRepository;
    }

    public function upgrateUser(Request $request) {
        $user = auth()->user();
        $user_id = $user->id;
        $user = $this->userRepository->getUserById($user_id);
        if($user->is_vip == 0) {
            $user->is_vip = 1;
            $user->save();
            return response()->json(['message' => 'You are now a VIP member']);
        } else {
            return response()->json(['message' => 'You are already a VIP member']);
        }

    }

    public function getAllUser() {
        $users = $this->userRepository->getAllUser();
        return response()->json(['users' => $users]);
    }
}
