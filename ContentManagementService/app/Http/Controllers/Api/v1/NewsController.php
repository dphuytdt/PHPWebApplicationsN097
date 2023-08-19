<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\NewsRepositoryInterfaces;

class NewsController extends Controller
{
    protected NewsRepositoryInterfaces $newsRepository;

    public function __construct(NewsRepositoryInterfaces $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function index()
    {
        $news = $this->newsRepository->index();
        return response()->json($news);
    }


    public function show($id)
    {
        $news = $this->newsRepository->show($id);
        return response()->json($news);
    }

    public function store(Request $request)
    {
        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description ?? '',
            'content' => $request->contents ?? '',
            'image' => $request->image ?? '',
            'image_extension' => $request->image_extension ?? '',
            'is_active' => $request->is_active ?? 1,
            'created_at' => now()
        ];

        try {
            $news = $this->newsRepository->store($data);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $news = $this->newsRepository->destroy($id);
            return response()->json($news, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $news = $this->newsRepository->update($request, $id);
            return response()->json($news, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function latest()
    {
        $news = $this->newsRepository->latest();
        return response()->json($news);
    }


    public function userIndex()
    {
        $news = $this->newsRepository->userIndex();
        $newRecent = $this->newsRepository->newRecent();

        $new= [
            'news' => $news,
            'newRecent' => $newRecent
        ];
        return response()->json($new);
    }
}
