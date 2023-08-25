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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $result = $this->slideShowRepository->create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Slide Show created successfully',
            'data' => $result
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = $this->slideShowRepository->getSlideShow($id);

        return response()->json($result, 200);
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
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
