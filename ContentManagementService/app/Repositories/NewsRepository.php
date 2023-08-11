<?php

namespace App\Repositories;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Interfaces\SlideShowRepositoryInterfaces;
use App\Models\News;

class NewsRepository implements NewsRepositoryInterfaces 
{
    private News $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

    public function store(Request $request)
    {
        $news = $this->news->create($request->all());
        return response()->json($news);
    }

    public function destroy($id)
    {
        $news = $this->news->find($id);
        try {
            $news->delete();
            return response()->json($news, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        $news = $this->news->find($id);
        try {
            $news->update($request->all());
            return response()->json($news, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        $news = $this->news->find($id);
        return response()->json($news);
    }

    public function index()
    {
        $news = $this->news->all();
        return response()->json($news);
    }
}