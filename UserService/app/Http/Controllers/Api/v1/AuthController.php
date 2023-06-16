<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailOTP;
use App\Jobs\SendEmailRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\OTPRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    private UserRepositoryInterface $userRepository;
    private OTPRepositoryInterface $otpRepository;
    public function __construct(UserRepositoryInterface $userRepository, OTPRepositoryInterface $otpRepository) {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'forgotPassword', 'verifyOTP', 'adminLogin', 'verifyAccount', 'resetPassword']]);
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

        $user = $this->userRepository->checkUserExist($request->email);
        if ($user->is_active == 0) {
            return response()->json(['error' => 'Please verify your email'], 400);
        }

        return $this->createNewToken($token);
    }
    
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $created_at = date('Y-m-d H:i:s');
        $request = $request->merge(['created_at' => $created_at]);
        $user = $this->userRepository->createUser($request->all());
        $email = $request->email;
        if ($user) {
            $otp = rand(100000, 999999);
            $user_id = $user->id;
            $userCheck = $this->otpRepository->checkUserExistInOTP($email, $user_id, 0);
            if ($userCheck == true) {
                $this->otpRepository->updateOTP($email, $otp, $user->id, 0);
                $user = [
                    'email' => $email,
                    'name' => $user->fullname,
                    'otp' => $otp,
                ];
            } else {
                $this->otpRepository->createOTP($email, $otp, $user_id, 0);
                $user = [
                    'email' => $email,
                    'name' => $user->fullname,
                    'otp' => $otp,
                    'type' => 0,
                ];
            }
            if (SendEmailRegister::dispatch($user)) {
                return response()->json([
                    'message' => 'User successfully registered',
                    'user' => $user
                ], 201);
            } else {
                $this->userRepository->deleteUser($email);
                return response()->json([
                    'error' => 'User register failed',
                ], 400);

            }
            return response()->json([
                'message' => 'User successfully registered',
                'user' => $user
            ], 201);
        } else {
            return response()->json([
                'error' => 'User register failed',
            ], 400);
        }
    }

    public function verifyAccount(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100',
            'otp' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $email = $request->email;
        $otp = $request->otp;
        $user = $this->userRepository->checkUserExist($email);
        if ($user) {
            $user_id = $user->id;
            $userCheck = $this->otpRepository->checkUserExistInOTP($email, $user_id, 0);
            if ($userCheck == true) {
                $otpCheck = $this->otpRepository->checkOTP($email, $otp, $user_id, 0);
                if ($otpCheck == true) {
                    $this->userRepository->updateUser($email);
                    $this->otpRepository->deleteOTP($email, $user_id, $otp, 0);
                    return response()->json([
                        'message' => 'User successfully verified',
                    ], 200);
                } else {
                    return response()->json([
                        'error' => 'OTP is incorrect',
                    ], 400);
                }
            } else {
                return response()->json([
                    'error' => 'Dont have any OTP for this user',
                ], 400);
            }
        } else {
            return response()->json([
                'error' => 'User does not exist',
            ], 400);
        }
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
        $user  = $this->userRepository->checkUserExist($email);
        if ($user) {
            $otp = rand(100000, 999999);
            $user_id = $user->id;
            $userCheck = $this->otpRepository->checkUserExistInOTP($email, $user_id, 1);
            if ($userCheck == true) {
                $this->otpRepository->updateOTP($email, $otp, $user->id, 1);
                $user = [
                    'email' => $email,
                    'name' => $user->fullname,
                    'otp' => $otp,
                ];
            } else {
                $this->otpRepository->createOTP($email, $otp, $user_id, 1);
                $user = [
                    'email' => $email,
                    'name' => $user->fullname,
                    'otp' => $otp,
                ];
            }
            if (SendEmailOTP::dispatch($user)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Email sent successfully',
                    'data' => $user,
                    'otp' => $otp,
                ], 200);
            } else {
                $this->otpRepository->deleteOTP($email, $user_id, $otp, 1);
                return response()->json([
                    'status' => false,
                    'message' => 'Email not sent',
                    'data' => $user,
                ], 400);
            }
        } else{
            return response()->json([
                'status' => false,
                'error' => 'Email not exist',
            ], 400);
        }

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
            $otp = $this->otpRepository->checkOTP($email, $otp, $user_id, 1);
            if ($otp == true) {
                $this->otpRepository->deleteOTP($email, $otp, $user_id, 1);
                return response()->json([
                    'status' => true,
                    'message' => 'OTP verified successfully',
                    'user' => $user,
                    'otp' => $otp,
                ], 200);
            }
            return response()->json([
                'status' => false,
                'error' => 'OTP not verified',
                'user' => $user,
            ], 400);
        }
        return response()->json(['error' => 'User not found'], 404);
    }

    public function resetPassword(Request $request) {
        $email = $request->email;
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user  = $this->userRepository->checkEmail($email);
        if ($user) {
            $user_id = $user->id;
            $password = Hash::make($request->password);
            $user = $this->userRepository->resetPassword($email, $password, $user_id);
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'error' => 'Password reset failed',
                    'user' => $user,
                ], 400);
            }
            $this->otpRepository->deleteOTP($email, $user_id, 1);
            return response()->json([
                'status' => true,
                'message' => 'Password reset successfully',
                'user' => $user,
            ], 200);
        }
        return response()->json(['error' => 'User not found'], 404);
    }

    public function resendOTP(Request $request) {
        $email = $request->email;
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user  = $this->userRepository->checkEmail($email);
        if ($user) {
            $otp = rand(100000, 999999);
            $user_id = $user->id;
            $userCheck = $this->otpRepository->checkUserExistInOTP($email, $user_id, 1);
            if ($userCheck == true) {
                $this->otpRepository->updateOTP($email, $otp, $user->id, 1);
                $user = [
                    'email' => $email,
                    'name' => $user->fullname,
                    'otp' => $otp,
                ];
            } else {
                $this->otpRepository->createOTP($email, $otp, $user_id, 1);
                $user = [
                    'email' => $email,
                    'name' => $user->fullname,
                    'otp' => $otp,
                ];
            }
            if (SendEmailOTP::dispatch($user)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Email sent successfully',
                    'data' => $user,
                    'otp' => $otp,
                ], 200);
            } else {
                $this->otpRepository->deleteOTP($email, $user_id, $otp, 1);
                return response()->json([
                    'status' => false,
                    'message' => 'Email not sent',
                    'data' => $user,
                ], 400);
            }
        } else{
            return response()->json([
                'status' => false,
                'error' => 'Email not exist',
            ], 400);
        }
    }

}
