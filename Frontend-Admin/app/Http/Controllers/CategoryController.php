<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CategoryController extends Controller
{
    private const BOOKS_SERVICE = 'http://bookservice.test:8080/api/';

    private const BOOKS_SERVICE_ADMIN = 'http://bookservice.test:8080/api/admin/';

    public function index(Request $request)
    {
        $client = new Client();

        try {
            $response = $client->get(self::BOOKS_SERVICE.'category/admin');
            $paginator = json_decode($response->getBody(), true);
//
//            foreach ($paginator as $key => $value) {
//                $paginator[$key]['image'] = base64_decode($value['image']);
//            }

            return view('home.category.list')->with('paginator', $paginator);
        } catch (\Exception $e) {
            return view('home.category.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('home.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageContents = file_get_contents($imageFile->getPathname());
            $base64Image = base64_encode($imageContents);
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'image' => $base64Image,
        ];

        $client = new Client();

        try{
            $client->post(self::BOOKS_SERVICE_ADMIN.'categories', [
                'form_params' => [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'image' => $data['image'],
                ]
            ]);
            return redirect()->route('category.index')->with('success', 'Create category successfully');
        } catch (\Exception|GuzzleException $e) {
            return view('home.category.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageContents = file_get_contents($imageFile->getPathname());
            $base64Image = base64_encode($imageContents);
        }

        $data = [
            'name' => $request->name,
            'image' => $base64Image,
            'description' => $request->description,
        ];

        $client = new Client();

        try {
            $client->post(self::BOOKS_SERVICE_ADMIN.'categories/'.$id, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'form_params' => [
                    'name' => $data['name'] ?? '',
                    'image' => $data['image'] ?? '',
                    'description' => $data['description'] ?? '',
                ]
            ]);
            return redirect()->route('category.index')->with('success', 'Update category successfully');
        } catch (\Exception|GuzzleException $e) {
            dd($e);
            // return view('home.category.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $client = new Client();
        try {
            $response = $client->post(self::BOOKS_SERVICE_ADMIN.'categories/delete'.$id);
            $categories = json_decode($response->getBody(), true);
            return redirect()->route('category.index')->with('success', 'Delete category successfully');
        } catch (\Exception $e) {
            dd($e);
            // return view('category.index')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }
}
