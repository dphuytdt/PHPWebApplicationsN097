<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Imports\CategoryImport;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'image' => $request->image ?? '',
            'image_extension' => $request->image_extension ?? '',
            'status' => $request->status ?? 1,
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
    public function update(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();

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

    public function import(Request $request)
    {
        DB::beginTransaction();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
        } else {
            return response()->json(['message' => 'No file selected']);
        }

        try {
            $categoryImport = new CategoryImport();
            $categoryImport->import($file);
            DB::commit();

            if($categoryImport->failures()->count() > 0) {
                return response()->json(['message' => 'Import user failed']);
            } else {
                return response()->json(['message' => 'Import user successfully']);
            }

        } catch (\Exception|\Error|\Throwable $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
