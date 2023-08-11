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
            dd($e);
            // return view('home.category.list')->withErrors(['errors' => 'Cannot connect to server']);
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
        $data = $request->all();
        $client = new Client();

        try {
            $response = $client->post(self::NEWS_SERVICE.'news', [
                'json' => $data
            ]);
            return redirect()->route('news.index')->with('success', 'Create news successfully');
        } catch (\Exception|GuzzleException $e) {
            return redirect()->route('news.create')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }
}
