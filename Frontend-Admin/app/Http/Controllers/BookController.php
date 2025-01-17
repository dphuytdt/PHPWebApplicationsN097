<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToText\Pdf;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
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
            $response = $client->get($this->bookService.'admin/books');
            $paginator = json_decode($response->getBody(), true);
            Log::channel('admin_log')->info('User: ' .  session('admin')['email'] . ' view book list' );
            return view('home.book.list', compact('paginator'));
        } catch (\Exception $e) {
            Log::channel('admin_log')->error('User: ' .  session('admin')['email'] . ' cannot view book list' );
            return view('home.category.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $client = new Client();
        try {
            $response = $client->get($this->bookService.'category/admin');
            $categories = json_decode($response->getBody(), true);
            Log::channel('admin_log')->info('User: ' .  session('admin')['email'] . ' view create book page' );
            return view('home.book.create', compact('categories'));
        } catch (\Exception $e) {
            Log::channel('admin_log')->error('User: ' .  session('admin')['email'] . ' cannot view create book page' );
            return view('home.book.create')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $imageFile = $request->file('image');
        $contentFile = $request->file('contentPdf');

        $imagePath = Cloudinary::upload($imageFile->getRealPath())->getSecurePath();
        $contentPath = Cloudinary::uploadFile($contentFile->getRealPath())->getSecurePath();


        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'discount' => $request->discount,
            'status' => $request->status,
            'is_vip_valid' => $request->is_vip_valid,
            'is_featured' => $request->is_featured,
            'image_extension' => 'jpg',
        ];

        if($imagePath && $contentPath) {

            $client = new Client();
            try{
                $client->post($this->bookService.'admin/books', [
                    'form_params' => [
                        'title' => $data['title'],
                        'description' => $data['description'],
                        'author' => $data['author'],
                        'category_id' => $data['category_id'],
                        'price' => $data['price'],
                        'discount' => $data['discount'],
                        'contentPdf' => $contentPath,
                        'status' => $data['status'],
                        'is_vip_valid' => $data['is_vip_valid'],
                        'is_featured' => $data['is_featured'],
                        'image' => $imagePath,
                        'image_extension' => $data['image_extension'],
                    ]
                ]);

                Log::channel('admin_log')->info('User: ' .  session('admin')['email'] . ' create book success' );
                return redirect()->back()->with('success', 'Create book successfully');
            } catch (\Exception|GuzzleException $e) {
                Log::channel('admin_log')->error('User: ' .  session('admin')['email'] . ' create book failed' );
                return redirect()->back()->with('errors', 'Cannot connect to server');
            }
        }

        Log::channel('admin_log')->error('User: ' .  session('admin')['email'] . ' create book failed' );
        return redirect()->route('books.index')->withErrors(['errors' => 'Cannot upload file']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = new Client();
        try {
            $response = $client->get($this->bookService.'admin/books/'.$id);
            $res= json_decode($response->getBody(), true);
            $book = $res['book'];
            $categories = $res['categories'];

            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' view edit book page' );
            return view('home.book.edit', compact('book', 'categories'));
        } catch (\Exception $e) {
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot view edit book page' );
            return view('home.book.edit')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function update(Request $request, string $id)
    {
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageExtension = $imageFile->getClientOriginalExtension();
            $imagePath = Cloudinary::upload($imageFile->getRealPath())->getSecurePath();
        } else {
            $imagePath = null;
            $imageExtension = 'png';
        }

        if ($request->hasFile('content')) {
            $contentFile = $request->file('content');
            $contentPath = Cloudinary::uploadFile($contentFile->getRealPath())->getSecurePath();
        } else {
            $contentPath = null;
        }

        $client = new Client();

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'discount' => $request->discount,
            'content' => $contentPath,
            'status' => $request->status,
            'cover_image' => $imagePath,
            'image_extension' => $imageExtension,
            'is_vip_valid' => $request->is_vip_valid ?? '',
            'is_featured' => $request->is_featured ?? ''
        ];

        try{
            $client->post($this->bookService.'admin/books/'.$id, [
                'form_params' => [
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'author' => $data['author'],
                    'category_id' => $data['category_id'],
                    'price' => $data['price'],
                    'discount' => $data['discount'],
                    'contentPdf' => $data['content'],
                    'status' => $data['status'],
                    'cover_image' => $data['cover_image'],
                    'image_extension' => $data['image_extension'],
                    'is_vip_valid' => $data['is_vip_valid'],
                    'is_featured' => $data['is_featured'],
                ]
            ]);

            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' update book success' );
            return redirect()->route('books.index')->with('success', 'Update book successfully');
        } catch (\Exception|GuzzleException $e) {
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' update book failed' );
            return redirect()->route('books.index')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function delete(string $id)
    {
        $client = new Client();
        try {
            $response = $client->delete($this->bookService.'admin/books/'.$id);
            $result = json_decode($response->getBody(), true);
            if ($result['status'] == 200) {
                Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' delete book success');
                return redirect()->route('books.index')->with('success', 'Delete book successfully');
            } else {
                Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' delete book failed' );
                return redirect()->route('books.index')->withErrors(['errors' => 'Cannot delete book']);
            }
        } catch (\Exception $e) {
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' delete book failed' );
            return redirect()->route('books.index')->withErrors(['errors' => 'Cannot connect to server']);
        }

    }
}
