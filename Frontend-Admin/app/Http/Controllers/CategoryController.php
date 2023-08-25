<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
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

    public function index(Request $request)
    {
        $client = new Client();

        try {
            $response = $client->get($this->bookService.'category/admin');
            $paginator = json_decode($response->getBody(), true);

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
        $imageFile = $request->file('image');
        $pathImage = Storage::disk('dropbox')->putFile('categories/images', $imageFile);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'image' => $pathImage,
            'image_extension' => $imageFile->getClientOriginalExtension(),
        ];

        $client = new Client();

        try{
            $client->post($this->bookService.'admin/categories', [
                'form_params' => [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'image' => $data['image'],
                    'image_extension' => $data['image_extension'],
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
        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageContents = file_get_contents($imageFile->getPathname());
            $base64Image = base64_encode($imageContents);
            $imageExtension = $request->file('image')->getClientOriginalExtension();
            $data['image'] = $base64Image;
            $data['image_extension'] = $imageExtension;
        }

        $client = new Client();

        try {
            $client->post($this->bookService.'admin/categories/'.$id, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'form_params' => [
                    $data
                ]
            ]);
            return redirect()->route('category.index')->with('success', 'Update category successfully');
        } catch (\Exception|GuzzleException $e) {
            return view('home.category.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function delete(string $id)
    {
        $client = new Client();

        try {
            $client->post($this->bookService.'admin/categories/delete'.$id);
            return redirect()->route('category.index')->with('success', 'Delete category successfully');
        } catch (\Exception $e) {
            return view('category.index')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }
}
