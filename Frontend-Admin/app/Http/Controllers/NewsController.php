<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

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
            $response = $client->get($this->contentService.'admin/news');
            $news = json_decode($response->getBody(), true);

            return view('home.news.list', compact('news'));
        } catch (\Exception|GuzzleException $e) {
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
                $imageFile = $request->file('image');
                $imageContents = file_get_contents($imageFile->getPathname());
                $imageExtension = $request->file('image')->getClientOriginalExtension();
                $base64Image = base64_encode($imageContents);
            } catch (\Exception $e) {
                return redirect()->route('books.index')->withErrors(['errors' => 'Cannot read file']);
            }
        }

        $client = new Client();

        try {
            $client->post($this->contentService.'admin/news', [
                'form_params' => [
                    'title' => $request->title,
                    'slug' => $request->slug,
                    'description' => $request->description,
                    'contents' => $request->contents,
                    'image' => $base64Image,
                    'image_extension' => $imageExtension,
                    'is_active' => $request->is_active,
                    'creadted_by' => $request->creadted_by,
                ]
            ]);

            return redirect()->route('news.index')->with('success', 'Create news successfully');
        } catch (\Exception|GuzzleException $e) {
            dd($e);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $client = new Client();

        try {
            $client->put($this->contentService.'admin/news/'.$id, [
                'json' => $data
            ]);
            return redirect()->route('news.index')->with('success', 'Update news successfully');
        } catch (\Exception|GuzzleException $e) {
            return redirect()->route('news.edit', $id)->withErrors(['errors' => 'Cannot connect to server']);
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
            return redirect()->route('news.index')->with('success', 'Import news successfully');
        } catch (\Exception|GuzzleException $e) {
            return redirect()->route('news.index')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }
}
