<?php

namespace App\Http\Controllers;


use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use GuzzleHttp\Client;

class CartController extends Controller
{
    public $bookService = 'http://bookservice.test:8080/api/';
    public $paymentService = 'http://paymentservice.test:8080/api/';
    protected $categoryService;

    private const DOLLAR_RATE = 23000;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function getUserCart($id)
    {
        if (!session()->has('token')) {
            // Người dùng chưa đăng nhập, chuyển hướng đến trang login
            return redirect()->route('login');
        }
        $categories = $this->categoryService->getCategory();
        $client = new Client();
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
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        } catch (GuzzleException $e) {
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
            // Người dùng chưa đăng nhập, chuyển hướng đến trang login
            return redirect()->route('login');
        }
        $categories = $this->categoryService->getCategory();
        $client = new Client();
        try {
            $response = $client->get($this->paymentService.'cart/get/'.$id);
            $response = json_decode($response->getBody()->getContents());
            $cart = $response->result;
            return view('main.cart.checkout', compact('categories', 'cart'));
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        } catch (GuzzleException $e) {
            return response()->json($e->getMessage());
        }
    }

    public function payment(Request $request)
    {

        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://frontend.test:8080/cart/1";
        $vnp_TmnCode = "1ACLHH74";//Mã website tại VNPAY
        $vnp_HashSecret = "TMEVRTPDXCOKQKXQLZFNKDROUCTMWXHS"; //Chuỗi bí mật

        $vnp_TxnRef = $request->id;
        $vnp_OrderInfo = "Test payment";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->price * self::DOLLAR_RATE * 100;
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

        $this->paymentSuccess($request);

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

    private function paymentSuccess($data)
    {
        $client = new Client();

        try{
            $response = $client->post($this->paymentService.'cart/checkout', [
                'form_params' => [
                    "bookId" => $data->bookId,
                    "userID" => $data->userID,
                    "price" => $data->price,
                ]
            ]);
            $response = json_decode($response->getBody()->getContents());
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        } catch (GuzzleException $e) {
            return response()->json($e->getMessage());
        }
    }
}
