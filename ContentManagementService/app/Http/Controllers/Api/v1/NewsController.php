<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Interfaces\CommentsRepositoryInterfaces;
use App\Models\Book;
use App\Models\News;
use App\Repositories\CommentsRepository;
use Illuminate\Http\Request;
use App\Interfaces\NewsRepositoryInterfaces;

class NewsController extends Controller
{
    protected NewsRepositoryInterfaces $newsRepository;

    protected CommentsRepositoryInterfaces $commentsRepository;

    public function __construct(NewsRepositoryInterfaces $newsRepository, CommentsRepositoryInterfaces $commentsRepository)
    {
        $this->newsRepository = $newsRepository;
        $this->commentsRepository = $commentsRepository;
    }

    public function index()
    {
        $result = $this->newsRepository->index();
        return response()->json($result);
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
            'tags' => $request->tags ?? '',
            'creadted_by' => $request->creadted_by ?? '',
            'created_at' => now()
        ];

        try {
            $this->newsRepository->store($data);
            return response()->json($data, 200);
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
        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description ?? '',
            'content' => $request->contents ?? '',
            'image' => $request->image ?? '',
            'is_active' => $request->is_active ?? 1,
            'tags' => $request->tags ?? '',
            'creadted_by' => $request->creadted_by ?? '',
            'created_at' => now()
        ];

        try {
            $news = $this->newsRepository->update($data, $id);
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
        $tags = $this->newsRepository->tags();

        $new= [
            'news' => $news,
            'newsRecent' => $newRecent,
            'tags' => $tags,
        ];
        return response()->json($new);
    }

    public function userLatest()
    {
        $news = $this->newsRepository->userLatest();
        return response()->json($news);
    }

    public function search(string $keyword)
    {
        $news = News::where('title', 'like', "%{$keyword}%")
            ->orWhere('description', 'like', "%{$keyword}%")
            ->orWhere('content', 'like', "%{$keyword}%")
            ->orWhere('is_active', 'like', "%{$keyword}%")
            ->orWhere('creadted_by', 'like', "%{$keyword}%")->paginate(8);

        return response()->json($news);
    }

    public function newsDetail($id)
    {
        $news = $this->newsRepository->newsDetail($id);
        $comment = $this->commentsRepository->getComments($id);

        $new= [
            'news' => $news,
            'comment' => $comment,
        ];

        return response()->json($new);
    }
}
