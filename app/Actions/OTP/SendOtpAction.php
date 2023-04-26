<?php

namespace App\Actions\OTP;

use App\Models\OtpVerification;
use Illuminate\Http\Request;
use App\Models\SmsLog;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\ClientException;
// use Lorisleiva\Actions\Concerns\AsAction;

final class SendOtpAction
{
    // use AsAction;

    protected $request;

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $mobile = $this->request->mobile;
        // $user = DB::table('users')->where('mobile',$this->request->mobile)->first();
            $digit = mt_rand(1000, 9999);
            $message = $digit .' is your '.env('APP_NAME').' verification code.';

            OtpVerification::create([
                'mobile_number'=>$mobile,
                'verify_token'=>$digit,
            ]);

            // Mail::to($user)->send(new SendOtpMail($digit));
            // $sms = new SMS;
            return $this->sendSMS($mobile,$message);
    }

    public function sendSMS($phone, $message)
    {

        $check = substr($phone, 0, 3);
        $validNumber = in_array($check,[984,985,986,981,980,982]);
        if (!$validNumber){
            return response()->json([
                'message' =>'Invalid phone number',
            ],422);
        }
        $request_params = [
            // "st" => "s",
            // "mt" => "1",
            "mobile" => $phone,
            "message" => $message,
        ];

        $user_id = null;
        if (auth()->user())
            $user_id = auth()->user()->id;

        $sms_log = SmsLog::create([
            'message' => $message,
            'number' => $phone,
            'request' => $request_params,
            'user_id' => $user_id,
            "provider" => "sociar sms"
        ]);

        try {
            $client = new Client(['verify' => false, 'timeout' => 15]);
            if (config("app.env") == 'production') {
                $res = $client->post('https://sms.sociair.com/api/sms', [
                    'json' => $request_params,
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . env('SMS_TOKEN')
                    ]
                ]);

                $response = $res->getBody()->getContents();
//                $response = json_decode($response);
//                Log::info("Message sent  to $phone with message $message ");
                $sms_log->response = [
                    "status" => true,
                    "message" => $response
                ];
                $sms_log->save();

            }
            return response()->json(['message'=>'verification code has been sent'],200);

        } catch (ClientException $exception) {
            Log::error('Cannot sent message to mobile ' . $exception->getMessage());
            $sms_log->response = [
                'status' => false,
                'message' => $exception->getMessage()
            ];
            $sms_log->resent = 1;
            $sms_log->save();
            return response()->json(['message'=>'Failed to send verification code. Please try later! '],400);

        } catch (\Exception $exception) {
            Log::error('Cannot sent message to mobile ' . $exception->getMessage());
            $sms_log->response = [
                'status' => false,
                'message' => $exception->getMessage()
            ];
            $sms_log->resent = 1;
            $sms_log->save();
            return response()->json(['message'=>'Failed to send verification code. Please try later! '],400);
        }

    }
}
