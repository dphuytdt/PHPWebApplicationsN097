<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SystemController extends Controller
{
    public function setting()
    {
        Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' view system setting' );
        return view('home.system.setting');
    }

    public function checkLog()
    {
        Log::channel('admin_log')->info('Admin: ' .  session('admin')['email'] . ' view system log' );

        $logs = file_get_contents(storage_path('logs/admin_log-2023-08-27.log'));

        $pattern = '/\[(.*?)\]/';
        preg_match_all($pattern, $logs, $matches);
        $logsTimes = $matches[1];

        $pattern = '/local.INFO:(.*?)\n/';
        preg_match_all($pattern, $logs, $matches);
        $logsContent = $matches[1];

        $logs = array();
        for ($i = 0; $i < count($logsTimes); $i++) {
            $logs[$i]['time'] = $logsTimes[$i];
            $logs[$i]['content'] = $logsContent[$i];
        }

        return view('home.system.logging', ['logs' => $logs]);
    }
}
