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
        $news = $this->newsRepository->store($request);

        return response()->json($news, 201);
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
