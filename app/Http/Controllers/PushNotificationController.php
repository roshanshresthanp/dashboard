<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\WebPushNotification;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    public function storeToken(Request $request)
    {
        auth()->user()->update(['fcm_token'=>$request->token]);
        return response()->json(['Token successfully stored.']);
    }

    public function sendTest()
    {
        $data = [
            'title' => 'thisis title',
            'body' => 'THis is a body',
        ];

        $push = new WebPushNotification();
        $push->sendPushNotification($data,User::whereNotNull('fcm_token')->pluck('fcm_token'));
  
        // $this->sendWebNotification($data);
    }
  
    public function sendWebNotification($request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = User::whereNotNull('fcm_token')->pluck('fcm_token');
        dd($FcmToken);
          
        $serverKey = 'AAAAxRNfywo:APA91bEVSqXnSEhrHmPsVYA_S1hKu-HyMkOZF5OPIQftESCtkYNpybykCtFsPjycaTC84jC2Sc57tNIi-ADpAgAoK13EPRRJiQiXbkSD1Is_avg61j0P9mKKub6tPp0MgDUS6HaU49kb';
        $data = [
            "registration_ids" => [1],
            "notification" => [
                'title' => $request['title'],
                'body' => $request['body'],
                'image'=>asset('admin/assets/media/logos/favicon.ico'),
                'sound' => 'default',
            ]
        ];
        $encodedData = json_encode($data);
    
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }        
        // Close connection
        curl_close($ch);  
    }
}
