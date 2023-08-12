<?php

namespace App\Repositories;

use App\Interfaces\SlideShowRepositoryInterfaces;
use \Illuminate\Http\JsonResponse;
use App\Models\SlideShow;

class SlideShowRepository implements SlideShowRepositoryInterfaces
{
    private SlideShow $slideShow;

    public function __construct(SlideShow $slideShow)
    {
        $this->slideShow = $slideShow;
    }

    public function index()
    {
        return $this->slideShow->all();
    }

    public function create($request): JsonResponse
    {
        $slideShow = $this->slideShow->create($request->all());
        return response()->json($slideShow);
    }

    public function show($id): JsonResponse
    {
        $slideShow = $this->slideShow->find($id);
        return response()->json($slideShow);
    }

    public function update($request, $id): JsonResponse
{
        $slideShow = $this->slideShow->find($id);
        try {
            $slideShow->update($request->all());
            return response()->json($slideShow, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        $slideShow = $this->slideShow->find($id);
        try {
            $slideShow->delete();
            return response()->json($slideShow, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
