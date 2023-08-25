<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideShowController extends Controller
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        try {
            $response = $client->get($this->contentService.'admin/slide-show');
            $paginator = json_decode($response->getBody(), true);
            return view('home.slide.list', compact('paginator'));
        } catch (\Exception|GuzzleException $e) {
            return view('home.slide.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function create()
    {
        return view('home.slide.add');
    }

    public function edit($id)
    {
        $client = new Client();
        try {
            $response = $client->get($this->contentService.'admin/slide-show/'.$id);
            $slide = json_decode($response->getBody(), true);
            return view('home.slide.edit', compact('slide'));
        } catch (\Exception|GuzzleException $e) {
            return view('home.slide.edit')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function update(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $pathImage = Storage::disk('dropbox')->putFile('slideShow/images', $image);
        }

        $client = new Client();
        try {
            $client->post($this->contentService.'admin/slide-show/'.$id, [
                'form_params' => [
                    'title' => $request->title,
                    'image' => $pathImage ?? null,
                    'is_active' => $request->is_active,
                ]
            ]);
            return redirect()->route('slides.index')->with('success', 'Update slide show successfully');
        } catch (\Exception|GuzzleException $e) {
            return redirect()->route('slides.index')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        $pathImage = Storage::disk('dropbox')->putFile('slideShow/images', $image);

        $client = new Client();
        try {
            $client->post($this->contentService.'admin/slide-show', [
                'form_params' => [
                    'image' => $pathImage,
                    'title' => $request->title,
                    'is_active' => $request->is_active,
                ]
            ]);
            return redirect()->route('slides.index')->with('success', 'Create slide show successfully');
        } catch (\Exception|GuzzleException $e) {
            return redirect()->route('slides.index')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function delete($id)
    {
        $client = new Client();
        try {
            $client->post($this->contentService.'admin/slide-show/delete/'.$id);
            return redirect()->route('slides.index')->with('success', 'Delete slide show successfully');
        } catch (\Exception|GuzzleException $e) {
            return redirect()->route('slides.index')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }
}
