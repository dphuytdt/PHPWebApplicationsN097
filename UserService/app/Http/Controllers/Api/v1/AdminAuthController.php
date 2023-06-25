<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailRequestPassword;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\OTPRepositoryInterface;

class AdminAuthController extends Controller
{
    
    private UserRepositoryInterface $userRepository;
    private OTPRepositoryInterface $otpRepository;

    public function __construct(UserRepositoryInterface $userRepository, OTPRepositoryInterface $otpRepository) {
        $this->middleware('auth:api', ['except' => ['login', 'requestResetPassword']]);
        $this->userRepository = $userRepository;
        $this->otpRepository = $otpRepository;
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $user = auth()->user();
        $role = $user->role;
        if($role === 'ROLE_ADMIN') {
            if ($user->is_active == 0) {
                return response()->json(['error' => 'Please verify your email'], 401);
            } else {
                return $this->createNewToken($token);
            }
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    public function requestResetPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);
        $user = $this->userRepository->getUserByEmail($request->email);
        if(!$user) {
            return response()->json(['message' => 'Email not found'], 404);
        }
        $role = $user->role;
        if($role != 'ROLE_ADMIN') {
            return response()->json(['message' => 'Email is not registered'], 404);
        } else {
            $randomPassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 10 );
            $data = [
                'email' => $user->email,
                'password' => $randomPassword
            ];
            if(SendEmailRequestPassword::dispatch($data)) {
                $newPassword = Hash::make($randomPassword);
                $result = $this->userRepository->updateAdminPassword($user->email, $newPassword);
                return response()->json(['message' => 'Email sent'], 200);
            } else {
                return response()->json(['message' => 'Something went wrong'], 500);
            }
        }
    }
}
