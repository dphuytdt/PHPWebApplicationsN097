<?php

namespace App\Repositories;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

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
}