<?php

namespace App\Repositories;

use App\Interfaces\CartRepositoryInterface;
use App\Models\Cart;
use App\Models\HistoryPayment;
use App\Models\UserBooks;

class CartRepository implements CartRepositoryInterface
{
    public function add($request)
    {
        $cart = new Cart();
        $cart->user_id = $request->userID;
        $cart->book_id = $request->bookID;
        $cart->title = $request->bookTitle;
        $cart->cover_image = $request->bookImage;
        $cart->image_extension = $request->bookImageExtension;
        $cart->price = floatval($request->bookPrice);
        $cart->status = 0;
        $cart->created_at = now();
        $cart->save();
        if($cart){
            return $cart;
        }else{
            return false;
        }
    }

    //get user cart
    public function getCart($userID)
    {
        $cart = Cart::where('user_id', $userID)->where('status', 0)->get();
        if($cart){
            return $cart;
        }else{
            return false;
        }
    }

    public function getCartBook($userID, $bookID)
    {
        $cart = Cart::where('user_id', $userID)->where('book_id', $bookID)->where('status', 0)->first();
        if($cart){
            return $cart;
        }else{
            return false;
        }
    }

    public function deleteCart($request)
    {
        $cart = Cart::where('user_id', $request->userID)->where('book_id', $request->bookID)->where('status', 0);
        
        if($cart){
            $cart->delete();
            return true;
        }else{
            return false;
        }
    }

    public function checkout($userId, $bookId, $totalPrice)
    {
        $cart = Cart::where('user_id', $userId)->where('status', 0)->get();
        if($cart) {
            $cart->status = 1;
        }

//        $userCart = new UserBooks;
//        $userCart->user_id = $userId;
//        $userCart->book_id = $bookId;

        $paymentHistory = new HistoryPayment();
        $paymentHistory->user_id = $userId;
        $paymentHistory->book_id = $bookId;
        $paymentHistory->total_price = $totalPrice;
        $paymentHistory->created_at = now();
        $paymentHistory->save();

        return true;
    }
}
