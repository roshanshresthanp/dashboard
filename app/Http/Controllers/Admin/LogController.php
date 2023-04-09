<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmsLog;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function smsLog()
    {
        return SmsLog::all();
    }

    public function emailLog()
    {
    }

    public function activityLog()
    {
        return Activity::paginate(50);
    }
}
