<?php

namespace App\Actions\OTP;

use App\Models\OtpVerification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

// use Lorisleiva\Actions\Concerns\AsAction;

final class VerifyOtpAction
{
    public function handle(Request $request)
    {
        // return $request->all();

        $otp = $request->otp;
        $mobile = $request->mobile;
        $checkOtp = DB::table('otp_verifications')->where('mobile_number',$mobile)->first();
        // $checkOtp = OtpVerification::latest()->firstWhere('mobile_number',$mobile);
        if($checkOtp)
        {
            if(Carbon::now()->diffInMinutes($checkOtp->created_at) > 4)
            {
                return response()->json(array(
                    'message' => 'Your OTP code has been expired. Please resend it'
                ), 400);
            }

            if($checkOtp->verify_token == $otp){
               
                return response()->json(array(
                    'message' => 'OTP code has been verified.'
                ), 200);

            }else{
                return response()->json(array(
                    'message' => 'OTP code verification failed !!'
                ), 400);

            }
        }else{
            return response()->json(array(
                'message' => 'Please resend your OTP to verify'
            ), 200);
        }

        
    }
}
