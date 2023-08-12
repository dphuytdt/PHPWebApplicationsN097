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
        $client = new Client();

        try {
            $client->post(self::NEWS_SERVICE.'news', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ],
                'form-param' => [
                    'title' => $request['title'],
                    'slug' => $request['slug'],
                    'description' => $request['description'],
                    'content' => $request['content'],
                    'image' => $request['image'],
                    'is_active' => $request['is_active'],
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
