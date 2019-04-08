<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home extends Controller
{
    public function index()
    {
        $monitorsListProduction = \App\Monitors::where(array('uptime_check_enabled' => 1, 'environment' => 'PRODUCTION'))->get();
        $monitorsListTesting = \App\Monitors::where(array('uptime_check_enabled' => 1, 'environment' => 'TESTING'))->get();
        $downCount = \App\Monitors::where('uptime_status', 'down')->count();
        return view('home', [
            'monitorsListProduction' => $monitorsListProduction,
            'monitorsListTesting' => $monitorsListTesting,
            'downCount' => $downCount
        ]);
    }
}
