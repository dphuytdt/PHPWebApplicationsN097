<?php

namespace App\Repositories;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Interfaces\SlideShowRepositoryInterfaces;
use App\Models\SlideShow;

class SlideShowRepository implements SlideShowRepositoryInterfaces 
{
    private SlideShow $slideShow;

    public function __construct(SlideShow $slideShow)
    {
        $this->slideShow = $slideShow;
    }
}