<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Book;
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

    //create category
    public function createCategory(array $data)
    {
        $category = Category::create($data);
        return $category;
    }

    //get category by id
    public function getCategoryById(string $id)
    {
        $category = Category::find($id);
        return $category;
    }

    public function deleteCategory(string $id)
    {
        $category = Category::find($id);

        if (is_null($category)) {
            return false;
        }

        $category->status = 0;
        $category->deleted_at = date('Y-m-d H:i:s');

        return $category->save();
    }

    public function updateCategory($data, $id)
    {
        $category = Category::find($id);

        if (is_null($category)) {
            return false;
        }

        if (isset($data['name']) && $data['name'] !== $category->name) {
            $category->name = $data['name'];
        }

        if (isset($data['status']) && $data['status'] !== $category->status) {
            if ($data['status'] == 1) {
                $category->status = 1;
                $category->deleted_at = null;
            } else {
                $category->status = 0;
                $category->deleted_at = date('Y-m-d H:i:s');
            }
        }

        if (isset($data['description']) && $data['description'] !== $category->description) {
            $category->description = $data['description'];
        }

        if (isset($data['image']) && $data['image'] !== $category->image) {
            $category->image = $data['image'];
            $category->image_extension = $data['image_extension'];
        }

        $category->updated_at = date('Y-m-d H:i:s');

        return $category->save();
    }
}
