<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategoryForAdmin()
    {
        $categories = $this->categoryRepository->getAllCategoryForAdmin();
        return response()->json($categories, 200);
    }

    //get category
    public function getSelectedCategory()
    {
        $categories = $this->categoryRepository->getSelectedCategory();
        return response()->json($categories, 200);
    }

    
    public function getCategory()
    {
        $categories = $this->categoryRepository->getAllCategory();
        return response()->json($categories, 200);
    }
}
