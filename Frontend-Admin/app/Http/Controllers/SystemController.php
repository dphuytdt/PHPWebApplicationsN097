<?php

namespace App\Http\Controllers;

use App\Exports\StatisticalExport;
use Barryvdh\DomPDF\PDF;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class SystemController extends Controller
{
    protected $bookService, $contentService, $userService, $paymentService, $interactionService;

    private const CSV_TYPE = 'csv';

    private const PDF_TYPE = 'pdf';

    public function __construct()
    {
        $this->bookService = env('BOOK_SERVICE_HOST', null);
        $this->contentService = env('CONTENT_MANAGEMENT_SERVICE_HOST', null);
        $this->userService = env('USER_SERVICE_HOST', null);
        $this->paymentService = env('PAYMENT_SERVICE_HOST', null);
        $this->interactionService = env('INTERACTION_SERVICE_HOST', null);
    }
    public function checkLog()
    {
        $logs = file_get_contents(storage_path('logs/admin_log.log'));
        Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' view system log' );

        $pattern = '/\[(.*?)\]/';
        preg_match_all($pattern, $logs, $matches);
        $logsTimes = $matches[1];

        $pattern = '/local.INFO:(.*?)\n/';
        preg_match_all($pattern, $logs, $matches);
        $logsContent = $matches[1];
        $logs = new \ArrayObject();
        for ($i = 0; $i < count($logsTimes); $i++) {
            $logs[$i]['time'] = $logsTimes[$i] ?? '';
            $logs[$i]['content'] = $logsContent[$i] ?? '';
        }

        return view('home.system.logging', ['logs' => $logs]);
    }

    public function getBilling()
    {
        Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' view system billing' );
         $client = new Client();

         try {
            $req = $client->get($this->paymentService . 'get-total-payment');
            $totalPayment = json_decode($req->getBody(), true);

             $response = $client->get($this->userService.'auth/admin/user', [
                 'headers' => [
                     'Authorization' => 'Bearer ' . session('adminToken'),
                     "Accept"=>"application/json"
                 ],

             ]);

             $users = json_decode($response->getBody(), true);
             $user_infor = $users['users'];

             $req1 = $client->get($this->bookService.'admin/books');
             $books = json_decode($req1->getBody(), true);

            return view('home.system.statistical')->with('totalPayment', $totalPayment)->with('user_infor', $user_infor)->with('book_infor', $books);
         } catch (\Throwable|\Exception|GuzzleException $e) {
             dd($e->getMessage());
             Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' view system billing error: ' . $e->getMessage());
             return redirect()->back()->with('error', 'Lỗi hệ thống');
         }
    }

    public function exportStatistical($type)
    {
        Log::channel('admin_log')->info('Admin: ' . session('admin')['email'] . ' export system billing');

        $client = new Client();

        try {
            $req = $client->get($this->paymentService . 'get-total-payment');
            $totalPayment = json_decode($req->getBody(), true);

            $response = $client->get($this->userService . 'auth/admin/user', [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('adminToken'),
                    "Accept" => "application/json"
                ],

            ]);
            $users = json_decode($response->getBody(), true);
            $user_infor = $users['users'];

            $req1 = $client->get($this->bookService . 'admin/books');
            $books = json_decode($req1->getBody(), true);

        } catch (\Throwable|\Exception|GuzzleException $e) {
            Log::channel('admin_log')->error('Admin: ' . session('admin')['email'] . ' export system billing error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Lỗi hệ thống');
        }

        foreach ($totalPayment as $key => $value) {
            foreach ($user_infor as $key1 => $value1) {
                if ($value['user_id'] == $value1['id']) {
                    $totalPayment[$key]['user_id'] = $value1['fullname'];
                }
            }

            foreach ($books as $key2 => $value2) {
                if ($value['book_id'] == $value2['id']) {
                    $totalPayment[$key]['book_id'] = $value2['title'];
                }
            }
        }

        $now = date('Y-m-d H:i:s');

        if ($type === self::CSV_TYPE) {
            return Excel::download(new StatisticalExport($totalPayment), 'statistical ' . $now . '.csv', \Maatwebsite\Excel\Excel::CSV);
        }

        return Excel::download(new StatisticalExport($totalPayment), 'statistical ' . $now . '.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }
}
