<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\OTPRepositoryInterface;
class AuthController extends Controller
{

    private UserRepositoryInterface $userRepository;
    private OTPRepositoryInterface $otpRepository;
    public function __construct(UserRepositoryInterface $userRepository, OTPRepositoryInterface $otpRepository) {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'forgotPassword', 'verifyOTP' ]]);
        $this->userRepository = $userRepository;
        $this->otpRepository = $otpRepository;
    }

    public function checkAuth(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            // Người dùng đã xác thực thành công
            return response()->json(['message' => 'Authenticated']);
        } catch (JWTException $e) {
            // Lỗi xác thực token
            return response()->json(['error' => 'Unauthorized'], 401);
        }
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

        return $this->createNewToken($token);
    }
    
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function userProfile() {
        return response()->json(auth()->user());
    }

    public function changePassWord(Request $request) {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string|min:6',
            'new_password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $userId = auth()->user()->id;

        $user = User::where('id', $userId)->update(
                    ['password' => bcrypt($request->new_password)]
                );

        return response()->json([
            'message' => 'User successfully changed password',
            'user' => $user,
        ], 201);
    }

    public function forgotPassword(Request $request) {
        $email = $request->email;
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user  = $this->userRepository->checkEmail($email);
        if ($user) {
            $user_id = $user->id;
            $otp = rand(100000, 999999);
            $this->otpRepository->createOTP($email, $otp, $user_id);
            $user = [
                'email' => $email,
                'name' => $user->name,
                'otp' => $otp,
            ];
            if (SendEmail::dispatch($user)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Email sent successfully',
                    'data' => $user,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Email not sent',
                    'data' => $user,
                ], 400);
            }
        }
        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'User found',
                'user' => $user,
            ], 200);
        }

        return response()->json(['error' => 'User not found'], 404);
    }

    public function verifyOTP(Request $request) {
        $email = $request->email;
        $otp = $request->otp;
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100',
            'otp' => 'required|string|max:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user  = $this->userRepository->checkEmail($email);
        if ($user) {
            $user_id = $user->id;
            $otp = $this->otpRepository->checkOTP($email, $otp, $user_id);
            if ($otp ==true) {
                //delete otp
                $this->otpRepository->deleteOTP($email, $otp, $user_id);
                return response()->json([
                    'status' => true,
                    'message' => 'OTP verified successfully',
                    'user' => $user,
                    'otp' => $otp,
                ], 200);
            }
            return response()->json([
                'status' => false,
                'message' => 'OTP not verified',
                'user' => $user,
            ], 400);
        }
        return response()->json(['error' => 'User not found'], 404);
    }

    public function adminLogin(Request $request){
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
        if ($user->role == 'admin') {
            return $this->createNewToken($token);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

}
