<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

interface CartRepositoryInterface
{
    public function add(Request $request);

}
