<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Book;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategory()
    {
        $categories = Category::orderBy('created_at', 'desc')->take(5)->get();
        return $categories;
    }

    public function getSelectedCategory()
    {
        $categories = Category::orderBy('created_at', 'desc')->take(8)->get();
        return $categories;
    }

    public function getAllCategoryForAdmin()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return $categories;
    }

    public function createCategory(array $data)
    {
        $category = Category::create($data);
        return $category;
    }

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

        if (
            ($data['image'] !== null && ($data['image'] !== $category->image))
        ) {
            $category->image = $data['image'];
        }

        $category->updated_at = date('Y-m-d H:i:s');

        return $category->save();
    }
    public function getCategory()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(8);
        return $categories;
    }
}
