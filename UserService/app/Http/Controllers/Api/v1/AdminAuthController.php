<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminAuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'requestResetPassword']]);
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
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $user = auth()->user();
        if ($user->role_id == 0) {
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
        $user = User::where('email', $request->email)->first();
        if(!$user) {
            return response()->json(['message' => 'Email not found'], 404);
        }
        //check user role
        if($user->role_id != 0) {
            return response()->json(['message' => 'Email is not registered'], 404);
        }
        // $otp = rand(100000, 999999);
        // $this->otpRepository->createOTP($user->id, $otp);
        // $user->notify(new ResetPassword($otp));
        // return response()->json(['message' => 'Send email successfully']);
    }
}
