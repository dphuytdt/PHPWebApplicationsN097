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
        //get top 10 category
        $categories = Category::orderBy('created_at', 'desc')->take(5)->get();
        return $categories;
    }

    //get selected category
    public function getSelectedCategory()
    {
        $categories = Category::orderBy('created_at', 'desc')->take(8)->get();
        return $categories;
    }

    //get all category for admin
    public function getAllCategoryForAdmin()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return $categories;
    }
}