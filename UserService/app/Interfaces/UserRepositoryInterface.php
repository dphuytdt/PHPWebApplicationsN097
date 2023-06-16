<?php

namespace App\Interfaces;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

interface UserRepositoryInterface 
{
    public function checkEmail($email);

    public function getUserById($id);

    public function checkUserExist($email);

    public function getAllUser();

    public function createUser($data);

    public function resetPassword($email, $password, $user_id);

    public function deleteUser($email);

    public function updateUser($email);

    public function upgradeUser($email, $amount,$numberMonth);

    public function getUserByemail($email);

    public function getUserDetail($user_id);
}