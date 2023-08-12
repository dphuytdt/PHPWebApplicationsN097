<?php

namespace App\Repositories;

use App\Interfaces\NewsRepositoryInterfaces;
use App\Models\News;

class NewsRepository implements NewsRepositoryInterfaces
{
    private News $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

    public function store($request)
    {
        $news = new News();

        $news->title = $request['title'];
        $news->slug = $request['slug'];
        $news->description = $request['description'];
        $news->content = $request['content'];
        $news->image = $request['image'];
        $news->is_active = $request['is_active'];
        $news->created_at = $request['created_at'];

        return $news->save();
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

    public function update($request, $id)
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
        return $this->news->all();
    }

    public function latest()
    {
        $news = $this->news->orderBy('created_at', 'desc')->take(3)->get();
        return response()->json($news);
    }

    public function userIndex()
    {
        $news = $this->news->orderBy('created_at', 'desc')->paginate(6);
        return response()->json($news);
    }

    public function newRecent()
    {
        $news = $this->news->orderBy('created_at', 'desc')->take(3)->get();
        return response()->json($news);
    }
}
