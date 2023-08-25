<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\CartRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    protected CartRepositoryInterface $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function add(Request $request)
    {
        $cart = $this->cartRepository->getCartBook($request->userID, $request->bookID);

        if($cart){
            return response()->json([
                'status' => 'error',
                'message' => 'Book already in cart'
            ], 400);
        }else{
            $bookImage = $request->bookImage;
            $imagePath = Storage::disk('dropbox')->putFile('cart/images', $bookImage);
            $request->bookImage = $imagePath;
            $result = $this->cartRepository->add($request);

            if($result){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Book added to cart successfully',
                    'data' => $result
                ], 200);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Book not added to cart',
                    'data' => null
                ], 400);
            }
        }
    }

    public function getCart($userID)
    {
        $result = $this->cartRepository->getCart($userID);

        if($result){
            return response()->json([
                'result' => $result
            ], 200);
          }else{
             return response()->json([
                 'status' => 'error',
             ], 400);
          }
    }

    public function deleteCart(Request $request)
    {
        $result = $this->cartRepository->deleteCart($request);
        if($result){
            return response()->json([
                'status' => 'success',
                'message' => 'Book deleted from cart successfully',
                'data' => $result
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Book not deleted from cart',
                'data' => null
            ], 400);
        }
    }

    public function checkout(Request $request)
    {
        $bookId = $request['bookId'];
        $userId = $request['useId'];
        $totalPrice = $request['price'];

        $result = $this->cartRepository->checkout($userId, $bookId, $totalPrice);

        if($result){
            return response()->json([
                'status' => 'success',
                'message' => 'Checkout successfully',
                'data' => $result
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Checkout failed',
                'data' => null
            ], 400);
        }
    }

    public function addPaymentHistory(Request $request) {
        $result = $this->cartRepository->addPaymentHistory($request);
        return response()->json([
            'status' => 'success',
            'message' => 'Payment successfully',
            'data' => $result
        ], 200);
    }
}
