<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
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

            Log::channel('admin_log')->info('User: ' .  session('admin')['email'] . ' view category list' );
            return view('home.category.list')->with('paginator', $paginator);
        } catch (\Exception $e) {
            Log::channel('admin_log')->error('User: ' .  session('admin')['email'] . ' cannot view category list' );
            return view('home.category.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function create()
    {
        Log::channel('admin_log')->info('User: ' .  session('admin')['email'] . ' view create category page' );
        return view('home.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $imageFile = $request->file('image');
        $pathImage = Cloudinary::upload($imageFile->getRealPath())->getSecurePath();

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'image' => $pathImage,
            'image_extension' => $imageFile->getClientOriginalExtension(),
            'status' => $request->status,
        ];

        $client = new Client();

        try{
            $client->post($this->bookService.'admin/categories', [
                'form_params' => [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'image' => $data['image'],
                    'image_extension' => $data['image_extension'],
                    'status' => $data['status'],
                ]
            ]);
            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' create category successfully' );
            return redirect()->route('category.index')->with('success', 'Create category successfully');
        } catch (\Exception|GuzzleException $e) {
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot create category' );
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
            $pathImage = Cloudinary::upload($imageFile->getRealPath())->getSecurePath();
        } else {
            $pathImage = null;
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'image' => $pathImage,
            'image_extension' => 'jpg', // TODO: get extension from file
            'status' => $request->status,
        ];

        $client = new Client();

        try {
            $client->post($this->bookService.'admin/categories/'.$id, [
                'form_params' => [
                    'name' => $data['name'] ?? '',
                    'description' => $data['description'] ?? '',
                    'image' => $data['image'],
                    'image_extension' => $data['image_extension'],
                    'status' => $data['status'] ?? 1,
                ]
            ]);

            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' update category successfully' );
            return redirect()->route('category.index')->with('success', 'Update category successfully');
        } catch (\Exception|GuzzleException $e) {
            dd($e);
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot update category' );
            return view('home.category.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function delete(string $id)
    {
        $client = new Client();

        try {
            $client->post($this->bookService.'admin/categories/delete'.$id);

            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' delete category successfully' );
            return redirect()->route('category.index')->with('success', 'Delete category successfully');
        } catch (\Exception $e) {

            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot delete category' );
            return view('category.index')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }
}
