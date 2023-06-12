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
}