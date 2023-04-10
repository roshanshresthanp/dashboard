<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmsLog;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function smsLog()
    {
        return DB::table('sms_logs')->get();
    }

    public function emailLog()
    {
    }

    public function activityLog()
    {
        // return DB::table('activity_log')->paginate(100);
        return Activity::paginate(100);
    }
}
