<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OtpVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    public function register1(Request $request)
    {
        return $request->all();
        $otp = $request->otp;
        $mobile = $request->user_mobile;

        $checkOtp = OtpVerification::latest()->firstWhere('mobile_number',$mobile);
        if($checkOtp)
        {
            if(Carbon::now()->diffInMinutes($checkOtp->created_at) > 3)
            {
                return response()->json(array(
                    'status' => 400,
                    'message' => 'Your OTP code has been expired. Please resend your otp'
                ), 400);
            }

            if($checkOtp->verify_token == $otp){
                $data = $request->all();
                $dateConverter =  new NilambarDateConverter() ;
                $data['estd_at'] = $dateConverter->nepToEng($request->estd_at);
                $data['registered_date'] = $dateConverter->nepToEng($request->registered_date);
                $data['status'] = 0;
                try{
                    DB::beginTransaction();

                    College::create($data);

                    User::create([
                        'name'=>$request->user_full_name,
                        'username'=>$request->username,
                        'mobile'=>$request->user_mobile,
                        'email'=>$request->user_email
                    ]);

                    DB::commit();
                    return response()->json(array(
                        'status' => 200,
                        'message' => 'You have been verified successfully. Please login your account'
                    ), 200);

                }catch(\Exception $e){
                    DB::rollBack();

                        return response()->json(array(
                        'status' => 400,
                        // 'message'=>$e->getMessage()
                        'message' => 'Sorry, we are failed to add record at this time'
                    ), 400);
                }
            }else{
                return response()->json(array(
                    'status' => 400,
                    'message' => 'OTP Code verification failed !!'
                ), 400);

            }


        }else{
            return response()->json(array(
                'status' => 400,
                'message' => 'Please resend your OTP to verify'
            ), 400);
        }


    }


    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('LaravelAuthApp')->accessToken;
        return response()->json(['token' => $token], 200);
    }
}
