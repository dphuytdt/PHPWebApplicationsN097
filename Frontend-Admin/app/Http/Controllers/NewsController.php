<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    protected $bookService, $contentService, $userService, $paymentService, $interactionService;

    public function __construct()
    {
        $this->bookService = env('BOOK_SERVICE_HOST', null);
        $this->contentService = env('CONTENT_MANAGEMENT_SERVICE_HOST', null);
        $this->userService = env('USER_SERVICE_HOST', null);
        $this->paymentService = env('PAYMENT_SERVICE_HOST', null);
        $this->interactionService = env('INTERACTION_SERVICE_HOST', null);
    }

    public function index()
    {
        $client = new Client();
        try {
            $req= $client->get($this->contentService.'admin/news');
            $res= json_decode($req->getBody(), true);

            $news = $res['news'];
            $tags = $res['tags'];

            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' view news list' );
            return view('home.news.list', compact('news', 'tags'));
        } catch (\Exception|GuzzleException $e) {
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot view news list' );
            return view('home.category.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function create()
    {
        return view('home.news.create');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            try{
                $image = $request->file('image');
                $pathImage = Cloudinary::upload($image->getRealPath())->getSecurePath();
            } catch (\Exception $e) {
                Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot read file' );
                return redirect()->route('books.index')->withErrors(['errors' => 'Cannot read file']);
            }
        }

        $client = new Client();

        try {
            $client->post($this->contentService.'admin/news', [
                'form_params' => [
                    'title' => $request->title ?? '',
                    'slug' => $request->slug ?? '',
                    'description' => $request->description ?? '',
                    'contents' => $request->contents ?? '',
                    'image' => $pathImage ?? '',
                    'image_extension' => 'jpg', // TODO: get extension from file
                    'is_active' => $request->is_active ?? 1,
                    'tags' => $request->tags ?? '',
                    'creadted_by' => $request->creadted_by,
                ]
            ]);

            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' create news successfully' );
            return redirect()->route('news.index')->with('success', 'Create news successfully');
        } catch (\Exception|GuzzleException $e) {
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot create news' );
            return redirect()->route('news.index')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function update(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            try{
                $image = $request->file('image');
                $pathImage = Cloudinary::upload($image->getRealPath())->getSecurePath();
            } catch (\Exception $e) {
                return redirect()->route('news.index')->withErrors(['errors' => 'Cannot read file']);
            }
        }

        $data = [
            'title' => $request->title ?? '',
            'slug' => $request->slug ?? '',
            'description' => $request->description ?? '',
            'contents' => $request->contents ?? '',
            'image' => $pathImage ?? '',
            'is_active' => $request->is_active ?? 1,
            'tags' => $request->tags ?? '',
            'creadted_by' => $request->creadted_by ?? '',
        ];
        $client = new Client();

        try {
            $client->post($this->contentService.'admin/news/'.$id, [
                'json' => $data
            ]);

            $req= $client->get($this->contentService.'admin/news');
            $res= json_decode($req->getBody(), true);

            $news = $res['news'];
            $tags = $res['tags'];

            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' update news successfully' );
            return redirect()->back()->with(compact('news', 'tags'));
        } catch (\Exception|GuzzleException $e) {
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot update news' );
            return redirect()->back()->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function import(Request $request)
    {
        $data = $request->all();
        $client = new Client();

        try {
            $client->post($this->contentService.'admin/news/import', [
                'json' => $data
            ]);

            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' import news successfully' );
            return redirect()->route('news.index')->with('success', 'Import news successfully');
        } catch (\Exception|GuzzleException $e) {
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot import news' );
            return redirect()->route('news.index')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }
}
