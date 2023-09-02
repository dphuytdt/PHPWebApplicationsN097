<?php

namespace App\Http\Controllers;

use App\Exports\StatisticalExport;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class SystemController extends Controller
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

            return view('home.system.statistical')->with('totalPayment', $totalPayment);
         } catch (\Throwable|\Exception|GuzzleException $e) {
             dd($e->getMessage());
             Log::channel('admin_log')->error('Admin: ' .  session('admin')['email'] . ' view system billing error: ' . $e->getMessage());
             return redirect()->back()->with('error', 'Lỗi hệ thống');
         }
    }

    public function exportStatistical()
    {
        Log::channel('admin_log')->info('Admin: ' . session('admin')['email'] . ' export system billing');

        $client = new Client();

        try {
            $req = $client->get($this->paymentService . 'get-total-payment');
            $totalPayment = json_decode($req->getBody(), true);

        } catch (\Throwable|\Exception|GuzzleException $e) {
            Log::channel('admin_log')->error('Admin: ' . session('admin')['email'] . ' export system billing error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Lỗi hệ thống');
        }


        $now = date('Y-m-d H:i:s');

        return Excel::download(new StatisticalExport($totalPayment), 'statistical ' . $now . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }
}
