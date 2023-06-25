<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\CartRepositoryInterface;
class CartController extends Controller
{
    protected CartRepositoryInterface $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function add(Request $request)
    {
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
