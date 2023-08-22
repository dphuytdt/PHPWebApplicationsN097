<?php
namespace App\Services;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class CategoryService
{
    private const BOOK_SERVICE = 'http://bookservice.test:8080/api/';
    public function getCategory()
    {
        $minutes = 60 * 24 * 30 * 3 * 12;

//        Cache::forget('categories');

        return Cache::remember('categories', $minutes, function () {
            $client = new Client();
            try {
                $response = $client->get(self::BOOK_SERVICE . 'category', ['timeout' => 60]);
                return json_decode($response->getBody(), true);
            } catch (\Exception $e) {
                return [];
            }
        });
    }


}
