<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface 
{
    //get all category
    public function getAllCategory()
    {
        $categories = Category::all();
        return $categories;
    }
}