<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewer;

class LogsController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['permission:logs']);
    }
    public function LogView()
    {
        $logViewer = new LaravelLogViewer();
        $data['logs'] = $logViewer->all();
        // dd($data['logs']);
        return view('backend.admin.log.view_log', $data);
    }
}
