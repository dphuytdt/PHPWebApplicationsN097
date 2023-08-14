<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $created_at = now();
        $data = [
            'name' => $request->name,
            'description' => $request->description ?? '',
            'image' => $request->image,
            'created_at' => $created_at
        ];

        try{
            $category = $this->categoryRepository->createCategory($data);
            return response()->json($category, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $category = $this->categoryRepository->getCategoryById($id);
            return response()->json($category, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updated_at = date('Y-m-d H:i:s');

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
            'updated_at' => $updated_at
        ];

        try{
            $category = $this->categoryRepository->updateCategory($data, $id);
            return response()->json($category, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = $this->categoryRepository->deleteCategory($id);
            return response()->json($category, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
