<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        $data = $request->all();
        $user = [
            'email' => $data['email'],
            'name' => $data['name'],
        ];
        $otp = rand(100000, 999999);
        $user['otp'] = $otp;
        if (SendEmail::dispatch($data, $user)) {
            return response()->json([
                'status' => true,
                'message' => 'Email sent successfully',
                'data' => $user,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Email not sent',
                'data' => $user,
            ], 400);
        }
    }
}
