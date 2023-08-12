<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\WishlistRepositoryInterface;

class WishlistController extends Controller
{
    protected WishlistRepositoryInterface $wishlistRepository;

    public function __construct(WishlistRepositoryInterface $wishlistRepository)
    {
        $this->wishlistRepository = $wishlistRepository;
    }

    public function add(Request $request)
    {
        $wishlist = $this->wishlistRepository->getWishlistBook($request->userID, $request->bookID);
        if($wishlist){
            return response()->json([
                'status' => 'error',
                'message' => 'Book already in wishlist'
            ], 400);
        }else{
            $result = $this->wishlistRepository->add($request);
            if($result){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Book added to wishlist successfully',
                    'data' => $result
                ], 200);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Book not added to wishlist',
                    'data' => null
                ], 400);
            }
        }
    }

    public function getWishlist($userID)
    {
        $result = $this->wishlistRepository->getWishlist($userID);
        if($result){
            return response()->json($result, 200);
        }else{
            return response()->json([
                'status' => 'error',
            ], 400);
        }
    }

    public function deleteWishlist(Request $request)
    {
        $userID = $request->userID;
        $bookID = $request->bookID;
        $result = $this->wishlistRepository->deleteWishlist($userID, $bookID);
        if($result){
            return response()->json([
                'status' => 'success',
                'message' => 'Book deleted from wishlist successfully',
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Book not found in wishlist',
            ], 400);
        }
    }
}
