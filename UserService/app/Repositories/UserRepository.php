<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Models\UserDetail;
class UserRepository implements UserRepositoryInterface
{
    private User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function checkEmail($email)
    {
        return $this->user->where('email', $email)->first();
    }

    public function getUserById($id)
    {
        return $this->user->where('id', $id)->first();
    }

    public function checkUserExist($email)
    {
        $user = $this->user->where('email', $email)->first();
        return $user;
    }

    public function getAllUser()
    {
        $user = $this->user->all();
        //get user detail for each user
        foreach($user as $u) {
            $user_detail = UserDetail::where('user_id', $u->id)->first();
            $u->user_detail = $user_detail;
        }
        return $user;
    }

    public function createUser($data)
    {
        $user = $this->user->create($data);
        $user_detail = new UserDetail();
        $user_detail->user_id = $user->id;
        $user_detail->save();
        return $user;
    }

    public function resetPassword($email, $password, $user_id)
    {
        $user = $this->user->where('email', $email)->first();
        $user->password = $password;
        $user->save();
        return $user;
    }

    public function deleteUser($email)
    {
        $user = $this->user->where('email', $email)->first();

        $user->is_active = 0;
        return $user->save();
    }

    public function updateUser($email)
    {
        $user = $this->user->where('email', $email)->first();
        $user->is_active = 1;
        $user->save();
        return $user;
    }

    public function upgradeUser($email, $amount, $numberMonth)
    {
        $user_id = $email->id;
        $user_detail = UserDetail::where('user_id', $email->id)->first();
        $wallet = $user_detail->wallet;
        if($wallet <= $amount) {
            return false;
        } else {
            $wallet = $wallet - $amount;
            $user_detail->wallet = $wallet;
            $user_detail->save();
            $email->is_vip = 1;
            $expired_date = date('Y-m-d H:i:s', strtotime('+'.$numberMonth.' month'));
            $email->valid_vip = $expired_date;
            $email->save();
            return true;
        }
        return $email;
    }

    public function getUserByemail($email)
    {
        $user = $this->user->where('email', $email)->first();
        return $user;
    }

    public function getUserDetail($user_id)
    {
        $user = $this->user->where('id', $user_id)->first();
        $user_detail = UserDetail::where('user_id', $user_id)->first();
        $user->user_detail = $user_detail;
        return $user;
    }

    public function updateAdminPassword($email, $password)
    {
        $user = $this->user->where('email', $email)->first();
        $user->password = $password;
        $user->is_active = 1;
        $user->save();
        return $user;
    }

    public function adminUpdateUser($data, $id)
    {
        $user = $this->user->where('id', $id)->first();
        $user->fullname = $data['fullname'];
        $user->is_active = $data['is_active'];
        if( $data['is_active'] == 0){
            $user->deleted_at = date('Y-m-d H:i:s');
        }
        $user->role = $data['role'];
        return $user->save();
    }
    public function updateProfile($request, $id)
    {
        $user = $this->user->where('id', $id)->first();
        $user->fullname = $request->fullname ?? $user->fullname;

        $userDetail = UserDetail::where('user_id', $id)->first();
        $userDetail->phone = $request->phone ?? $userDetail->phone;
        $userDetail->address = $request->address ?? $userDetail->address;
        $userDetail->birthday = $request->birthday ?? $userDetail->birthday;
        $userDetail->gender = $request->gender ?? $userDetail->gender;

        $userDetail->save();

        return $user->save();
    }
}
