<?php

namespace App\Services;

use App\Models\SmsLog;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\ClientException;

class SMS{

    public function isValidNumber($number)
    {
        $check = substr($number, 0, 3);
        $validNumber = in_array($check,[984,985,986,981,980,982]);
        if ($validNumber)
            return true;
        // dd($validNumber);
        return response()->json([
            'message' =>'Invalid phone number',
        ],422);
        // abort(404);
    }

    public function sendSMS($phone, $message)
    {

        return $this->isValidNumber($phone);
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
            return true;

        } catch (ClientException $exception) {
            Log::error('Cannot sent message to mobile ' . $exception->getMessage());
            $sms_log->response = [
                'status' => false,
                'message' => $exception->getMessage()
            ];
            $sms_log->resent = 1;
            $sms_log->save();
            return false;
        } catch (\Exception $exception) {
            Log::error('Cannot sent message to mobile ' . $exception->getMessage());
            $sms_log->response = [
                'status' => false,
                'message' => $exception->getMessage()
            ];
            $sms_log->resent = 1;
            $sms_log->save();
            return false;
        }

    }

}
