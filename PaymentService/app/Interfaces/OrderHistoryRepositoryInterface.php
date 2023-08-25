<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

interface OrderHistoryRepositoryInterface
{
    public function getOrderHistory($userID);

    public function isPayment($bookID, $userID);
}
