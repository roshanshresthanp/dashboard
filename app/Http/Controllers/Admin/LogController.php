<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmsLog;
use App\Services\SMS;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function smsLog()
    {
        $all = [
            'data' => DB::table('sms_logs')->get()
        ];
        return view('admin.sms.index',$all);
    }

    public function smsResend($id)
    {
        return redirect()->back()->with('success','Sms sent successfully');
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
