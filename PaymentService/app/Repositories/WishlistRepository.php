<?php

namespace App\Repositories;

use App\Interfaces\WishlistRepositoryInterface;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Storage;

class WishlistRepository implements WishlistRepositoryInterface
{

    public function add($request)
    {
        $wishlist = new Wishlist();
        $wishlist->user_id = $request->userID;
        $wishlist->book_id = $request->bookID;
        $wishlist->title = $request->bookTitle;
        $wishlist->cover_image = $request->bookImage;
        $wishlist->image_extension = $request->bookImageExtension;
        $wishlist->price = $request->bookPrice;
        $wishlist->status = 0;
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
        $wishlist = Wishlist::where('user_id', $userID)->where('status', 0)->get();

        foreach ($wishlist as $key => $value) {
            $value->cover_image = Storage::disk('dropbox')->url($value->cover_image);
        }

        return $wishlist ? $wishlist : false;
    }

    public function getWishlistBook($userID, $bookID)
    {
        $wishlist = Wishlist::where('user_id', $userID)->where('book_id', $bookID)->where('status', 0)->first();

        return $wishlist;
    }

    public function deleteWishlist($userID, $bookID)
    {
        $wishlist = Wishlist::where('user_id', $userID)->where('book_id', $bookID)->where('status', 0)->delete();
        if($wishlist){
            return true;
        }else{
            return false;
        }
    }

}
