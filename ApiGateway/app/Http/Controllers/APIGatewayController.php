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
        $token = $request->header('Authorization');

        // Kiểm tra xác thực token
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Gửi yêu cầu đến UserService để xác thực token và lấy thông tin người dùng
        $client = new Client();
        try {
            $response = $client->request('GET', 'http://userservice.test:8080/api/auth/user-profile', [
                'headers' => [
                    'Authorization' => $token,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = json_decode($response->getBody()->getContents());
        if (!$user || $response->getStatusCode() != 200 ) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Gửi yêu cầu đến microservice khác
        $response = $client->request($request->method(), 'http://'.$request->path(), [
            'headers' => [
                'Authorization' => $token,
            ],
            'form_params' => $request->all(),
        ]);

        // Trả về kết quả từ microservice khác cho frontend
        return response($response->getBody(), $response->getStatusCode());
    }
}
