<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private const NEWS_SERVICE = 'http://contentmanagementservice.test:8080/api/admin/';

    public function index()
    {
        $client = new Client();
        try {
            $response = $client->get(self::NEWS_SERVICE.'news');
            $news = json_decode($response->getBody(), true);

            return view('home.news.list', compact('news'));
        } catch (\Exception|GuzzleException $e) {
            return view('home.category.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('home.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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
            $client->post(self::NEWS_SERVICE.'news', [
                'form_params' => [
                    'title' => $request->title,
                    'slug' => $request->slug,
                    'description' => $request->description,
                    'contents' => $request->contents,
                    'image' => $base64Image,
                    'image_extension' => $imageExtension,
                    'is_active' => $request->is_active,
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
            $response = $client->put(self::NEWS_SERVICE.'news/'.$id, [
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
            $response = $client->post(self::NEWS_SERVICE.'news/import', [
                'json' => $data
            ]);
            return redirect()->route('news.index')->with('success', 'Import news successfully');
        } catch (\Exception|GuzzleException $e) {
            return redirect()->route('news.index')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }
}
