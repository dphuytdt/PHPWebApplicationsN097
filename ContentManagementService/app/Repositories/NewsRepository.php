<?php

namespace App\Repositories;

use App\Interfaces\NewsRepositoryInterfaces;
use App\Models\News;
use App\Models\Tag;

class NewsRepository implements NewsRepositoryInterfaces
{
    private News $news;

    private Tag $tag;

    public function __construct(News $news, Tag $tag)
    {
        $this->news = $news;
        $this->tag = $tag;
    }

    public function store(array $data)
    {
        $news = News::create($data);

        $tagModel = new Tag();

        $tags = explode(',', $data['tags']);
        foreach ($tags as $tag) {
            $tagModel->firstOrCreate(['tag_name' => $tag, 'created_at' => now()]);
        }

        return $news;
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

    public function update(array $data, $id)
    {
        $news = $this->news->find($id);

        if(
            (isset($data['title']) && $data['title'] != $news->title)
            || ($data['title'] !== '' && $data['title'] != $news->title)
        ) {
            $news->title = $data['title'];
        }

        if(
            (isset($data['slug']) && $data['slug'] != $news->slug)
            || ($data['slug'] !== '' && $data['slug'] != $news->slug)
        ) {
            $news->slug = $data['slug'];
        }

        if(
            (isset($data['description']) && $data['description'] != $news->description)
            || ($data['description'] !== '' && $data['description'] != $news->description)
        ) {
            $news->description = $data['description'];
        }

        if(
            (isset($data['content']) && $data['content'] != $news->content)
            || ($data['content'] !== '' && $data['content'] != $news->content)
        ) {
            $news->content = $data['content'];
        }

        if(
            (isset($data['image']) && $data['image'] != $news->image)
            || ($data['image'] !== '' && $data['image'] != $news->image)
        ) {
            $news->image = $data['image'];
        }

        if(
            (isset($data['is_active']) && $data['is_active'] != $news->is_active)
            || ($data['is_active'] !== '' && $data['is_active'] != $news->is_active)
        ) {
            $news->is_active = $data['is_active'];
        }

        if(
            (isset($data['tags']) && $data['tags'] != $news->tags)
            || ($data['tags'] !== '' && $data['tags'] != $news->tags)
        ) {
            $news->tags = $data['tags'];
            $tags = explode(',', $data['tags']);
            $tagModel = new Tag();
            foreach ($tags as $tag) {
                $tagModel->firstOrCreate(['tag_name' => $tag, 'created_at' => now()]);
            }
        }

        $news->updated_at = now();

        return $news->save();
    }

    public function show($id)
    {
        $news = $this->news->find($id);
        return response()->json($news);
    }

    public function index()
    {
       $news = $this->news->all();
       $tags = $this->tag->all();
       return ['news' => $news, 'tags' => $tags];
    }

    public function latest()
    {
        $news = $this->news->orderBy('created_at', 'desc')->take(3)->get();
        return response()->json($news);
    }

    public function userIndex()
    {
        return $this->news->orderBy('created_at', 'desc')->paginate(6);
    }

    public function newRecent()
    {
        return $this->news->orderBy('created_at', 'desc')->take(3)->get();
    }

    public function userLatest()
    {
        return $this->news->orderBy('created_at', 'desc')->take(3)->get();
    }
}
