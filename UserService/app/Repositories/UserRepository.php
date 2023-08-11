<?php

namespace App\Repositories;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
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
        return $user->delete();
    }

    public function updateUser($email) 
    {
        $user = $this->user->where('email', $email)->first();
        $user->is_active = 1;
        $user->save();
        return $user;
    }

    public function upgradeUser($user, $amount,$numberMonth)
    {
        $user_id = $user->id;
        $user_detail = UserDetail::where('user_id', $user->id)->first();
        $wallet = $user_detail->wallet;
        if($wallet <= $amount) {
            return false;
        } else {
            $wallet = $wallet - $amount;
            $user_detail->wallet = $wallet;
            $user_detail->save();
            $user->is_vip = 1;
            $expired_date = date('Y-m-d H:i:s', strtotime('+'.$numberMonth.' month'));
            $user->valid_vip = $expired_date;
            $user->save();
            return true;
        }
        return $user;
    }

    public function getUserByemail($email) 
    {
        $user = $this->user->where('email', $email)->first();
        return $user;
    }

    public function getUserDetail($user_id) 
    {
        $user_detail = UserDetail::where('user_id', $user_id)->first();
        return $user_detail;
    }

    public function updateAdminPassword($email, $password) 
    {
        $user = $this->user->where('email', $email)->first();
        $user->password = $password;
        $user->is_active = 1;
        $user->save();
        return $user;
    }
}