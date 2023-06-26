<?php

namespace App\Repositories;

use App\Interfaces\WishlistRepositoryInterface;
use App\Models\Wishlist;

class WishlistRepository implements WishlistRepositoryInterface
{

    public function add($request)
    {
        $wishlist = new Wishlist();
        $wishlist->user_id = $request->userID;
        $wishlist->book_id = $request->bookID;
        $wishlist->title = $request->bookTitle;
        $wishlist->cover_image = $request->bookImage;
        $wishlist->price = $request->bookPrice;
        $wishlist->created_at = now();
        $wishlist->save();
        if($wishlist){
            return $wishlist;
        }else{
            return false;
        }
    }

    public function getWishlist($userID)
    {
        $wishlist = Wishlist::where('user_id', $userID)->get();
        return $wishlist;
    }

    public function getWishlistBook($userID, $bookID)
    {
        $wishlist = Wishlist::where('user_id', $userID)->where('book_id', $bookID)->first();
        return $wishlist;
    }

    public function deleteWishlist($userID, $bookID)
    {
        $wishlist = Wishlist::where('user_id', $userID)->where('book_id', $bookID)->delete();
        if($wishlist){
            return true;
        }else{
            return false;
        }
    }

}