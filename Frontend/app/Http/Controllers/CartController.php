<?php

namespace App\Http\Controllers;


use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use GuzzleHttp\Client;

class CartController extends Controller
{

    protected $categoryService, $bookService, $contentService, $userService, $paymentService, $interactionService, $redirectUrl;

    private const DOLLAR_RATE = 23000;

    private const VN_PAY = 'vnpay';

    private const MOMO = 'momo';

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

    public function getUserCart($id)
    {
        if (!session()->has('token')) {
            return redirect()->route('login');
        }

        $client = new Client();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

        try {
            $response = $client->get($this->paymentService.'cart/get/'.$id);
            $response = json_decode($response->getBody()->getContents());
            $cart = $response->result;
            return view('main.cart.index', compact('categories', 'cart'));
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        } catch (GuzzleException $e) {
            return response()->json($e->getMessage());
        }
    }

    public function addToCart(Request $request)
    {
        $client = new Client();

        try {
            $client->post($this->paymentService.'cart/add', [
                'form_params' => [
                    "userID" => $request->userID,
                    "bookID" => $request->bookID,
                    "bookTitle" => $request->bookTitle,
                    "bookPrice" => $request->bookPrice,
                    "bookImage" => $request->bookImage
                ]
            ]);

            return redirect()->route('cart.getUserCart', ['id' => $request->userID]);
        } catch (\Exception|GuzzleException $e) {
            return response()->json($e->getMessage());
        }
    }

    public function addToCartFromWishlist(Request $request)
    {
        $client = new Client();

        try {
            $response = $client->post($this->paymentService.'cart/add', [
                'form_params' => [
                    "userID" => $request->userID,
                    "bookID" => $request->bookID,
                    "bookTitle" => $request->bookTitle,
                    "bookPrice" => $request->bookPrice,
                    "bookImage" => $request->bookImage
                ]
            ]);
            $response = json_decode($response->getBody()->getContents());
            return redirect()->route('cart.getUserCart', ['id' => $request->userID]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        } catch (GuzzleException $e) {
            return response()->json($e->getMessage());
        }
    }



    public function checkout($id)
    {
        if (!session()->has('token')) {
            return redirect()->route('login');
        }

        $client = new Client();

        $req2 = $client->get($this->bookService . 'category');
        $categories = json_decode($req2->getBody(), true);

        try {
            $response = $client->get($this->paymentService.'cart/get/'.$id);
            $response = json_decode($response->getBody()->getContents());
            $cart = $response->result;

            return view('main.cart.checkout', compact('categories', 'cart'));
        } catch (\Exception|GuzzleException $e) {
            return response()->json($e->getMessage());
        }
    }

    public function payment(Request $request)
    {
        $data = $request->all();
        $client = new Client();

        try{
            $client->post($this->paymentService.'cart/checkout', [
                'form_params' => [
                    "bookId" => $data['bookId'],
                    "useId" => $data['useId'],
                    "price" => $data['price'],
                ]
            ]);


            if($data['payment'] == self::VN_PAY) {
                error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
                date_default_timezone_set('Asia/Ho_Chi_Minh');

                $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                $vnp_Returnurl = $this->redirectUrl;
                $vnp_TmnCode = "1ACLHH74";
                $vnp_HashSecret = "TMEVRTPDXCOKQKXQLZFNKDROUCTMWXHS";

                $vnp_TxnRef = $request->id . now()->timestamp;
                $vnp_OrderInfo = "User Name: " . $request->userName . " - Payment for order: " . $request->id;
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
            print_r($e->getMessage());
        }
        return redirect()->back();
    }

    public function paymentMomo(Request $request)
    {
        $data = $request->all();
        $client = new Client();

        try{
            $client->post($this->paymentService.'cart/checkout', [
                'form_params' => [
                    "bookId" => $data['bookId'],
                    "useId" => $data['useId'],
                    "price" => $data['price'],
                ]
            ]);

            if($data['payment'] == self::MOMO) {
                $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
                $partnerCode = 'MOMOBKUN20180529';
                $accessKey = 'klm05TvNBzhg7h7j';
                $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
                $orderInfo = "Thanh toán qua MoMo";
                $amount = $request->total * self::DOLLAR_RATE;
                $orderId = $request->id . time();
                $redirectUrl = $this->redirectUrl;
                $ipnUrl = $redirectUrl;
                $extraData = "";

                $requestId = time() . "";
                $requestType = "payWithATM";
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                $signature = hash_hmac("sha256", $rawHash, $secretKey);
                $data = array('partnerCode' => $partnerCode,
                    'partnerName' => "Test",
                    "storeId" => "BookStoreN097",
                    'requestId' => $requestId,
                    'amount' => $amount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'redirectUrl' => $redirectUrl,
                    'ipnUrl' => $ipnUrl,
                    'lang' => 'vi',
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature);
                $result = $this->execPostRequest($endpoint, json_encode($data));
                $jsonResult = json_decode($result, true);
                if($jsonResult['payUrl']){
                    return  redirect()->to($jsonResult['payUrl']);
                }
            }
        } catch (\Exception| GuzzleException $e) {
            print_r($e->getMessage());
        }
        return redirect()->back();
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
        //execute post
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

}
