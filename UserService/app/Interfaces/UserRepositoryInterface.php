<?php

namespace App\Interfaces;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

interface UserRepositoryInterface 
{
    public function checkEmail($email);

    public function getUserById($id);

    public function checkUserExist($email);
}