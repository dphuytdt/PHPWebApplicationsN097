<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\CategoryService;

class PaymentController extends Controller
{
    private const DOLLAR_RATE = 23000;

    private const REDIRECT_URL = 'http://frontend.test:8080/thankYou';

    private const USER_SERVICE = 'http://userservice.test:8080/api/auth/';

    private const VN_PAY = 'vnpay';

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function payment(Request $request)
    {
        $data = $request->all();

        $client = new Client();

         //get datetime now for mat dd-mm-yyyy hh:mm:ss
        $data['currentTimestamp'] = now()->format('d-m-Y H:i:s');

        try{
            $client->post(self::USER_SERVICE . 'upgrade-vip', [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('token'),
                    "Accept"=>"application/json"
                ],
                'form_params' => [
                    "userId" => $data['userId'],
                    "dateStart" => $data['currentTimestamp'],
                    "plan" => $data['plan']
                ]
            ]);

            if($data['payment'] == self::VN_PAY) {
                error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
                date_default_timezone_set('Asia/Ho_Chi_Minh');

                $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                $vnp_Returnurl = self::REDIRECT_URL;
                $vnp_TmnCode = "1ACLHH74";
                $vnp_HashSecret = "TMEVRTPDXCOKQKXQLZFNKDROUCTMWXHS";

                $vnp_TxnRef = rand(1000000,999999999) . now()->timestamp;
                $vnp_OrderInfo = "User Name: " . $request->userName . " - Payment for order: " . $vnp_TxnRef;
                $vnp_OrderType = 'billpayment';
                $vnp_Amount = $request->total * self::DOLLAR_RATE * 100;
                $vnp_Locale = 'vn';
                $vnp_BankCode = 'NCB';
                $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                $inputData = array(
                    "vnp_Version" => "2.1.0",
                    "vnp_TmnCode" => $vnp_TmnCode,
                    "vnp_Amount" => $vnp_Amount,
                    "vnp_Command" => "pay",
                    "vnp_CreateDate" => date('YmdHis'),
                    "vnp_CurrCode" => "VND",
                    "vnp_IpAddr" => $vnp_IpAddr,
                    "vnp_Locale" => $vnp_Locale,
                    "vnp_OrderInfo" => $vnp_OrderInfo,
                    "vnp_OrderType" => $vnp_OrderType,
                    "vnp_ReturnUrl" => $vnp_Returnurl,
                    "vnp_TxnRef" => $vnp_TxnRef
                );

                if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                    $inputData['vnp_BankCode'] = $vnp_BankCode;
                }
                if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                    $inputData['vnp_Bill_State'] = $vnp_Bill_State;
                }

                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }

                $vnp_Url = $vnp_Url . "?" . $query;
                if (isset($vnp_HashSecret)) {
                    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
                    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                }

                $returnData = array('code' => '00'
                , 'message' => 'success'
                , 'data' => $vnp_Url);

                if (isset($_POST['redirect'])) {
                    header('Location: ' . $vnp_Url);
                    die();
                } else {
                    echo json_encode($returnData);
                }
            }
        } catch (\Exception| GuzzleException $e) {
            dd($e->getMessage());
        }
        //return redirect()->back();
    }

    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
