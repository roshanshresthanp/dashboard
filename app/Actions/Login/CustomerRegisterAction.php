<?php

namespace App\Actions\Login;

// use Lorisleiva\Actions\Concerns\AsAction;

use App\Models\OtpVerification;
use App\Models\User;
use App\Services\SMS;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Mail;


use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerRegisterAction
{
    // use AsAction;

    // protected $request;    

    // function __construct(Request $request)
    // {
    //     $this->request = $request;
    // }

    public function handle(Request $request)
    {
            $mobile = $request->mobile;
            DB::beginTransaction();
        try{

            $user = User::create([
                'mobile' => $mobile,
                'name' => $request->name,
                'password' => bcrypt($request->password)
            ]);
            $token = $user->createToken('MobileAuthApp')->accessToken;
            $user->roles()->attach([2]);
            $digit = mt_rand(1000, 9999);

            // Mail::to($user)->send(new SendOtpMail($digit));

            OtpVerification::create([
                'mobile_number'=>$mobile,
                'verify_token'=>$digit,
            ]);
            
            // $message = $digit . " is your otp code - ".env('APP_NAME');
            // $messageService = new SMS;
            // // $messageService->sendSMS($mobile, $message);

            DB::commit();
            return response()->json([
                'message' => 'Your verification code has been sent.',
                'token' => $token
            ],200);

            // return response()->json(['token' => $token], 200);
            }catch(\Exception $e){
                DB::rollBack();
                return response()->json([
                    // 'status'=>'Failed',
                    'message' => $e->getMessage(),
                ],422);
            }
    }
}
