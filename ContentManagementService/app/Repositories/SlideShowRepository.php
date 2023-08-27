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

    public function getAllSlideShows()
    {
        return  $this->slideShow->all();
    }

    public function create($data): JsonResponse
    {
        $result = $this->slideShow->create($data);

        return response()->json($result, 200);
    }

    public function getSlideShow($id): JsonResponse
    {
        $result = $this->slideShow->find($id);

        return response()->json($result, 200);
    }

    public function update($data, $id): JsonResponse
    {
        $slideShow = $this->slideShow->find($id);
        if (
            (isset($data['image']) && ($data['image']  !== $slideShow->image))
            || (($data['image'] != '') && ($data['image']  !== $slideShow->_image))
        ) {
            //Storage::disk('dropbox')->delete($book->cover_image);
            $slideShow->image = $data['image'];
        }

        if (isset($data['title']) && ($data['title']  !== $slideShow->title)) {
            $slideShow->title = $data['title'];
        }

        $slideShow->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Slide Show updated successfully',
            'data' => $slideShow
        ], 200);
    }

    public function delete($id): JsonResponse
    {
        $result = SlideShow::where('id', $id);

        $result->is_active = 0;
        $result->save();

        return response()->json($result, 200);
    }
}
