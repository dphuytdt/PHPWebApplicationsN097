<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

interface CartRepositoryInterface
{
    public function add(Request $request);

    public function getCart($userID);

    public function getCartBook($userID, $bookID);

    public function deleteCart(Request $request);

    public function checkout($userId, $bookId, $totalPrice);

}
