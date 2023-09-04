<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SlideShowRepository;
class SlideShowController extends Controller
{
    private SlideShowRepository $slideShowRepository;

    public function __construct(SlideShowRepository $slideShowRepository)
    {
        $this->slideShowRepository = $slideShowRepository;
    }

    public function index()
    {
        $result = $this->slideShowRepository->getAllSlideShows();

        return response()->json($result, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $createdAt = date('Y-m-d H:i:s');
        $data['created_at'] = $createdAt;

        $result = $this->slideShowRepository->create($data);

        return response()->json([], 200);
    }

    public function show(string $id)
    {
        $result = $this->slideShowRepository->getSlideShow($id);

        return response()->json($result, 200);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $result = $this->slideShowRepository->update($data, $id);

        return response()->json([
            'status' => 'success',
            'message' => 'Slide Show updated successfully',
            'data' => $result
        ], 200);
    }

    public function delete(string $id)
    {
        $result = $this->slideShowRepository->delete($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Slide Show deleted successfully',
            'data' => $result
        ], 200);
    }
}
