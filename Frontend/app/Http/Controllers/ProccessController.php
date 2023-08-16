<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class ProccessController extends Controller
{

    protected $categoryService;

    public $paymentService = 'http://paymentservice.test:8080/api/';

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    private function proccessPayment($data)
    {
        $client = new Client();

        try{
            $response = $client->post($this->paymentService.'cart/checkout', [
                'form_params' => [
                    "bookId" => $data->bookId,
                    "userID" => $data->userID,
                    "price" => $data->total,
                ]
            ]);

            $categories = $this->categoryService->getCategory();
            return view('main.cart.thankYou')->with('categories', $categories);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        } catch (GuzzleException $e) {
            return response()->json($e->getMessage());
        }
    }
}
