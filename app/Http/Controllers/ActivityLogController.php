<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function activityLog(){
        return view('admin.dashboard.activitylog')->with('activityLogs',ActivityLog::all());
    }
}
