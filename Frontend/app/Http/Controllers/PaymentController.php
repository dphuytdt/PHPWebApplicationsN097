<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\CategoryService;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class PaymentController extends Controller
{
    protected $categoryService, $bookService, $contentService, $userService, $paymentService, $interactionService, $redriectUrl;

    private const DOLLAR_RATE = 23000;

    private const VN_PAY = 'vnpay';

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->bookService = env('BOOK_SERVICE_HOST', null);
        $this->contentService = env('CONTENT_MANAGEMENT_SERVICE_HOST', null);
        $this->userService = env('USER_SERVICE_HOST', null);
        $this->paymentService = env('PAYMENT_SERVICE_HOST', null);
        $this->interactionService = env('INTERACTION_SERVICE_HOST', null);
        $this->redirectUrl = env('REDIRECT_URL', null);
    }

    public function payment(Request $request)
    {
        $data = $request->all();

        $client = new Client();

        $data['currentTimestamp'] = now()->format('d-m-Y H:i:s');

        try{
            $client->post($this->userService . 'auth/upgrade-vip', [
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

            $client->post($this->paymentService . 'add-payment-history', [
                'form_params' => [
                    "userId" => $data['userId'],
                    "bookId" => 0,
                    "totalPrice" => $data['total'],
                    "payment" => $data['payment'],
                    "date" => $data['currentTimestamp']
                ]
            ]);

            if(session()->has('user')){
                $user = session('user');
                $user['is_vip'] = 1;

                session()->put('user', $user);
            }

            if($data['payment'] == self::VN_PAY) {
                error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
                date_default_timezone_set('Asia/Ho_Chi_Minh');

                $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                $vnp_Returnurl = $this->redirectUrl;
                $vnp_TmnCode = "1ACLHH74";
                $vnp_HashSecret = "TMEVRTPDXCOKQKXQLZFNKDROUCTMWXHS";

                $vnp_TxnRef = now()->timestamp;
                $vnp_OrderInfo = "User Name: " . $request->userName . " - Payment for order Vip package";
                $vnp_OrderType = 'billpayment';
                $vnp_Amount = (int)$request->total * 100;
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
        } catch (\Exception|GuzzleException|NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            dd($e->getMessage());
        }
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
