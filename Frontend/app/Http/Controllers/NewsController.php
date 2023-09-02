<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsController extends Controller
{
    protected $categoryService, $bookService, $contentService, $userService, $paymentService, $interactionService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->bookService = env('BOOK_SERVICE_HOST', null);
        $this->contentService = env('CONTENT_MANAGEMENT_SERVICE_HOST', null);
        $this->userService = env('USER_SERVICE_HOST', null);
        $this->paymentService = env('PAYMENT_SERVICE_HOST', null);
        $this->interactionService = env('INTERACTION_SERVICE_HOST', null);
    }

    public function index(Request $request)
    {
        $client = new Client();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

        try{
            $response = $client->request('GET', $this->contentService . 'user/news');
            $data = json_decode($response->getBody()->getContents());

            if($data) {
                $res = json_decode($response->getBody(), true);
                $news = $res['news'];
                $perPage = 8;
                $currentPage = $request->query('page', 1);
                $paginator = new LengthAwarePaginator(
                    $news['data'],
                    $news['total'],
                    $perPage,
                    $currentPage,
                    ['path' => $request->url(), 'query' => $request->query()]
                );

                $recentNews = $res['newsRecent'];
                $tags = $res['tags'];

                return view('main.news.index')->with('paginator', $paginator)->with('categories', $categories)
                    ->with('recentNews', $recentNews)->with('tags', $tags);
            }

            return view('main.news.index')->with('categories', $categories);
        } catch(\Exception|GuzzleException $e) {
            return view('errors.404')->with('categories', $categories);
        }
    }

    public function show()
    {
        $client = new Client();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

        return view('main.news.show')->with('categories', $categories);
    }

    public function searchNews(Request $request)
    {
        $client = new Client();

        $keyword = $request->input('keyword');
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 2);

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

        try {
            $req = $client->get($this->contentService.'user/news/search/'.$keyword.'?page='.$page);

            if(json_decode($req->getBody(), true)){
                $news = json_decode($req->getBody(), true);

                $response = $client->request('GET', $this->contentService . 'user/news');
                $res = json_decode($response->getBody(), true);
                $recentNews = $res['newsRecent'];
                $tags = $res['tags'];

                $perPage = 8;
                $currentPage = $request->query('page', 1);

                $paginator = new LengthAwarePaginator(
                    $news['data'],
                    $news['total'],
                    $perPage,
                    $currentPage,
                    ['path' => $request->url(), 'query' => $request->query()]
                );
                return view('main.news.search-result', compact('paginator', 'categories', 'recentNews', 'tags', 'keyword'));
            }
            else{
                $paginator = [];
                return view('main.news.search-result')->with('error', 'No result found')->with('categories', $categories)->with('paginator', $paginator);
            }
        }
        catch (\Exception|GuzzleException $e) {
            $paginator = [];
            return view('main.news.search-result')->with('error', 'No result found')->with('categories', $categories)->with('paginator', $paginator);
        }
    }

    public function newsDetail($id)
    {
        $client = new Client();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

        try {
            $req = $client->get($this->contentService.'user/news/'.$id);
            $res = json_decode($req->getBody(), true);
            $news = $res['news'];
            $comment = $res['comment'];

            $totalComment = 0;
            $user = session()->get('user')['id'];
            $yourComment = [];
            foreach ($comment as $key => $value) {
                $totalComment += count($value);
                if ($value[0]['user_id'] == $user) {
                    unset($comment[$key]);
                    $yourComment[$key] = $value;
                }
            }

            $finalComment = $yourComment + $comment;

            $response = $client->request('GET', $this->contentService . 'user/news');
            $res = json_decode($response->getBody(), true);
            $recentNews = $res['newsRecent'];
            $tags = $res['tags'];

            return view('main.news.news-detail', compact('news', 'categories', 'recentNews', 'tags', 'finalComment', 'totalComment'));
        }
        catch (\Exception|GuzzleException $e) {
            return view('errors.404')->with('categories', $categories);
        }
    }

    public function viewMore(Request $request)
    {
        $client = new Client();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);


        try {
            $req = $client->get($this->contentService.'user/news/view-more');

            if(json_decode($req->getBody(), true)){
                $news = json_decode($req->getBody(), true);
                $recentNews = $news['newsRecent'];
                $tags = $news['tags'];

                $perPage = 8;
                $currentPage = $request->query('page', 1);

                $paginator = new LengthAwarePaginator(
                    $news['data'],
                    $news['total'],
                    $perPage,
                    $currentPage,
                    ['path' => $request->url(), 'query' => $request->query()]
                );
                return view('main.news.view-more', compact('paginator', 'recentNews', 'tags', 'categories'));
            }
            else{
                $paginator = [];
                return view('main.news.view-more')->with('error', 'No result found')->with('paginator', $paginator)->with('categories', $categories);
            }
        }
        catch (\Exception|GuzzleException $e) {
            $paginator = [];
            return view('main.news.view-more')->with('error', 'No result found')->with('paginator', $paginator)->with('categories', $categories);
        }
    }

    public function comment(Request $request) {
        $data = $request->all();
        $client = new Client();
        $user = session()->get('user');
        try {
            $response = $client->post($this->contentService.'comment', [
                'form_params' => [
                    'news_id' => $data['news_id'],
                    'user_id' => $user['id'],
                    'comment_name' => $user['fullname'],
                    'content' => $data['comment'],
                ]
            ]);
            $responseData = json_decode($response->getBody(), true);
            if($responseData) {
                return $responseData;
            } else {
                return redirect()->back()->with('error', 'Review failed!');
            }
        } catch (\Exception|GuzzleException $e) {
            return redirect()->back()->with('error', 'Review failed!');
        }
    }

    public function replyComment(Request $request) {
        $data = $request->all();
        $client = new Client();
        $user = session()->get('user');
        try {
            $response = $client->post($this->contentService.'comment/reply', [
                'form_params' => [
                    'news_id' => $data['news_id'],
                    'user_id' => $user['id'],
                    'comment_parent_id' => $data['parent_id'],
                    'comment_name' => $user['fullname'],
                    'content' => $data['comment'],
                ]
            ]);
            $responseData = json_decode($response->getBody(), true);
            if($responseData) {
                return $responseData;
            } else {
                return redirect()->back()->with('error', 'Review failed!');
            }
        } catch (\Exception|GuzzleException $e) {
            return redirect()->back()->with('error', 'Review failed!');
        }
    }

    public function deleteComment(Request $request) {
        $data = $request->all();
        $client = new Client();
        try {
            $response = $client->post($this->contentService.'comment/delete/', [
                'form_params' => [
                    'news_id' => $data['news_id'],
                    'comment_id' => $data['comment_id'],
                    'is_reply' => $data['is_reply'],
                ]
            ]);
            $responseData = json_decode($response->getBody(), true);

            if($responseData) {
                return $responseData;
            } else {
                return redirect()->back()->with('error', 'Delete failed!');
            }
        } catch (\Exception|GuzzleException $e) {
            return redirect()->back()->with('error', 'Delete failed!');
        }
    }

    public function updateComment(Request $request) {
        $data = $request->all();
        $client = new Client();
        try {
            $response = $client->put($this->contentService.'comment/'.$data['comment_id'], [
                'form_params' => [
                    'news_id' => $data['news_id'],
                    'content' => $data['comment'],
                ]
            ]);
            $responseData = json_decode($response->getBody(), true);

            if($responseData) {
                return $responseData;
            } else {
                return redirect()->back()->with('error', 'Update failed!');
            }
        } catch (\Exception|GuzzleException $e) {
            return redirect()->back()->with('error', 'Update failed!');
        }
    }
}
