<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
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
        Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' access to dashboard' );
        $client = new Client();

        try {
            $req = $client->get($this->paymentService . 'get-total-payment');
            $totalPayment = json_decode($req->getBody(), true);

            $sum = 0;

            foreach ($totalPayment as $key => $value) {
                $totalPayment[$key]['total_price'] = number_format($value['total_price'], 0, ',', '.');
                $sum += $value['total_price'];
            }
            return view('home.dashboard')->with('totalPayment', $totalPayment)->with('sum', $sum);
        } catch (\Throwable|\Exception|GuzzleException $e) {
            dd($e);
            return view('home.dashboard');
        }
    }

    public function handleError()
    {
        Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' have trouble with server' );
        return view('errors.404');
    }
}
