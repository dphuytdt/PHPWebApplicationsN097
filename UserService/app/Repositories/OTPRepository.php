<?php

namespace App\Repositories;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Interfaces\OTPRepositoryInterface;
use App\Models\User;
use App\Models\OTP;

class OTPRepository implements OTPRepositoryInterface 
{
    private OTP $otp;
    private User $user;

    public function __construct(OTP $otp, User $user) 
    {
        $this->otp = $otp;
        $this->user = $user;
    }

    public function createOTP($email, $otp, $user_id) 
    {
        $user = $this->user->where('id', $user_id)->first();
        if ($user) {
            $this->otp->create([
                'email' => $email,
                'otp' => $otp,
                'user_id' => $user_id
            ]);
        } else {
            $this->otp->where('user_id', $user_id)->update([
                'otp' => $otp
            ]);
        }

        return true;
    }

    public function checkOTP($email, $otp, $user_id) 
    {
        $otp = $this->otp->where('email', $email)->where('otp', $otp)->first();
        if ($otp) {
            return true;
        }
        return false;
    }

    public function deleteOTP($email, $otp, $user_id) 
    {
        return $this->otp->where('email', $email)->where('otp', $otp)->delete();
    }

    public function checkOTPExist($email) 
    {
        $otp = $this->otp->where('email', $email)->first();
        if ($otp) {
            return true;
        }

        return false;
    }
}