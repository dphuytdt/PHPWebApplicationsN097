<?php

// app/Http/Controllers/APIGatewayController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class APIGatewayController extends Controller
{
    public function proxyRequest(Request $request)
    {
        
    }
}
