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

    public function createOTP($email, $otp, $user_id,$type)
    {
        $user = $this->user->where('id', $user_id)->first();
        if ($user) {
            $this->otp->create([
                'email' => $email,
                'otp' => $otp,
                'type' => $type,
                'user_id' => $user_id
            ]);
        } else {
            $this->otp->where('user_id', $user_id)->update([
                'otp' => $otp
            ]);
        }

        return true;
    }

    public function checkOTP($email, $otp, $user_id,$type)
    {
        $otp = $this->otp->where('email', $email)->where('otp', $otp)->where('type', $type)->where('user_id', $user_id)->first();
        if ($otp) {
            return true;
        }
        return false;
    }

    public function updateOTP($email, $otp, $user_id, $type)
    {
        return $this->otp->where('email', $email)->where('user_id', $user_id)->where('type', $type)->update([
            'otp' => $otp
        ]);
    }

    public function checkUserExistInOTP($email, $user_id,$type)
    {
        $otp = $this->otp->where('email', $email)->where('user_id', $user_id)->where('type', $type)->first();
        if ($otp) {
            return true;
        }
        return false;
    }

    public function deleteOTP($email, $otp, $user_id, $type)
    {
        return $this->otp->where('email', $email)->where('otp', $otp)->where('user_id', $user_id)->where('type', $type)->delete();
    }

    public function generatePassword($length = 8)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }

    public function sendEmail($email, $password)
    {

    }
}
