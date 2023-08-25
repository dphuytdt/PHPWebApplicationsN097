<?php

namespace App\Repositories;

use App\Interfaces\CartRepositoryInterface;
use App\Interfaces\OrderHistoryRepositoryInterface;
use App\Models\Cart;
use App\Models\HistoryPayment;
use App\Models\UserBooks;

class OrderHistoryRepository implements OrderHistoryRepositoryInterface
{
    public function getOrderHistory($userID)
    {
        return HistoryPayment::where('user_id', $userID)->get();
    }

    public function isPayment($userId, $bookId)
    {
        $result = HistoryPayment::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->first();
        return (bool) $result;

    }
}
