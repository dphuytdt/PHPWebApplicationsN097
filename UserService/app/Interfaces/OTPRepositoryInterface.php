<?php

namespace App\Interfaces;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

interface OTPRepositoryInterface 
{
    public function createOTP($email, $otp, $user_id);

    public function checkOTP($email, $otp, $user_id);

    public function deleteOTP($email, $otp, $user_id);

    public function checkOTPExist($email);
}