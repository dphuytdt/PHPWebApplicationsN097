<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' view slide show list' );

            return view('home.slideShow.list', compact('paginator'));
        } catch (\Exception|GuzzleException $e) {
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot view slide show list' );

            return view('home.slideShow.list')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function create()
    {
        Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' view create slide show' );
        return view('home.slideShow.create');
    }

    public function edit($id)
    {
        $client = new Client();
        try {
            $response = $client->get($this->contentService.'admin/slide-show/'.$id);
            $slide = json_decode($response->getBody(), true);

            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' view edit slide show' );
            return view('home.slide.edit', compact('slide'));
        } catch (\Exception|GuzzleException $e) {
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot view edit slide show' );
            return view('home.slide.edit')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function update(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $pathImage = Cloudinary::upload($image->getRealPath())->getSecurePath();
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

            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' update slide show successfully' );
            return redirect()->route('slides.index')->with('success', 'Update slide show successfully');
        } catch (\Exception|GuzzleException $e) {
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot update slide show' );
            return redirect()->route('slides.index')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        $pathImage = Cloudinary::upload($image->getRealPath())->getSecurePath();

        $client = new Client();
        try {
            $client->post($this->contentService.'admin/slide-show', [
                'form_params' => [
                    'image' => $pathImage,
                    'title' => $request->title,
                    'is_active' => $request->is_active,
                ]
            ]);

            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' create slide show successfully' );
            return redirect()->route('slides.index')->with('success', 'Create slide show successfully');
        } catch (\Exception|GuzzleException $e) {
            dd($e);
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot create slide show' );
            return redirect()->route('slides.index')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }

    public function delete($id)
    {
        $client = new Client();
        try {
            $client->post($this->contentService.'admin/slide-show/delete/'.$id);

            Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' delete slide show successfully' );
            return redirect()->route('slides.index')->with('success', 'Delete slide show successfully');
        } catch (\Exception|GuzzleException $e) {
            Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' cannot delete slide show' );
            return redirect()->route('slides.index')->withErrors(['errors' => 'Cannot connect to server']);
        }
    }
}
