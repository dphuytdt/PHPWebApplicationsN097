<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

interface WishlistRepositoryInterface
{
    public function add($request);
    
    public function getWishlist($userID);

    public function getWishlistBook($userID, $bookID);

    public function deleteWishlist($userID, $bookID);
}
