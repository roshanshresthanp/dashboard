<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\SendOtpMail;
use App\Models\OtpVerification;
use App\Models\User;
use App\Services\SMS;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;


class RegisterController extends Controller
{

    public function register1(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|max:50|unique:users,email',
            // 'password' => ['required',Password::min(8)->letters()->numbers()->symbols()]
        ]);

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

     /**
     * @OA\Post(
     *   path="/register",
     *   tags={"Register"},
     *   operationId="reg",
     *
     *   @OA\RequestBody(
     *      @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *             example={
     *                 "mobile":"1111111111",
     *                 "password": "1111"
     *              }
     *         )
     *     )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/

    public function register(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'mobile'=>'required|regex:/\b\d{10}\b/|unique:users,mobile',
            'password'=>'required|regex:/\b\d{4}\b/',
            // 'password' => ['required',Password::min(8)->letters()->numbers()->symbols()]
            // 'email' => 'required|email|max:50|unique:users,email',
            // 'password' => ['required',Password::min(8)->letters()->numbers()->symbols()]
        ]);

        $mobile = $request->mobile;
            DB::beginTransaction();
        try{

            $user = User::create([
                'mobile' => $mobile,
                'name' => $request->name,
                'password' => bcrypt($request->password)
            ]);
            $token = $user->createToken('MobileAuthApp')->accessToken;
            
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
