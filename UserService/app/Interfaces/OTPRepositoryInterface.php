<?php

namespace App\Interfaces;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

interface OTPRepositoryInterface
{
    public function createOTP($email, $otp, $user_id, $type);

    public function checkOTP($email, $otp, $user_id, $type);

    public function updateOTP($email, $otp, $user_id, $type);

    public function checkUserExistInOTP($email, $user_id, $type);

    public function deleteOTP($email, $otp, $user_id, $type);

    public function generatePassword($length = 8);


}
