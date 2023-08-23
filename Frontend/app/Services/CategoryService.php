<?php
namespace App\Services;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class CategoryService
{
    protected $bookService;

    public function __construct()
    {
        $this->bookService = env('BOOK_SERVICE_HOST', null);
    }

    public function getCategory()
    {
        $minutes = 60 * 24 * 30 * 3 * 12;

        return Cache::remember('categories', $minutes, function () {
            $client = new Client();
            try {
                $response = $client->get($this->bookService . 'category');
                return json_decode($response->getBody(), true);
            } catch (\Exception $e) {
                return [];
            }
        });
    }


}
