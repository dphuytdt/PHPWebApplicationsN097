<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class ProccessController extends Controller
{

    protected $categoryService, $bookService, $contentService, $userService, $paymentService, $interactionService, $redriectUrl;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->bookService = env('BOOK_SERVICE_HOST', null);
        $this->contentService = env('CONTENT_MANAGEMENT_SERVICE_HOST', null);
        $this->userService = env('USER_SERVICE_HOST', null);
        $this->paymentService = env('PAYMENT_SERVICE_HOST', null);
        $this->interactionService = env('INTERACTION_SERVICE_HOST', null);
        $this->redriectUrl = env('REDIRECT_URL', null);
    }

    private function proccessPayment($data)
    {
        $client = new Client();

        try{
            $client->post($this->paymentService.'cart/checkout', [
                'form_params' => [
                    "bookId" => $data->bookId,
                    "userID" => $data->userID,
                    "price" => $data->total,
                ]
            ]);

            $req2 = $client->get($this->bookService . 'category');
            $categories = json_decode($req2->getBody(), true);

            return view('main.cart.thankYou')->with('categories', $categories);
        } catch (\Exception|GuzzleException $e) {
            return response()->json($e->getMessage());
        }
    }
}
