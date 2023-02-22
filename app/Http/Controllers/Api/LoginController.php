<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Registration
     */


    /**
     * Login
     */
    public function login(Request $request)
    {

        $log = $request->only('username','password');

        $validator = validate([
            'username'=>'email',
            'password'=>''
        ]);





        if (auth()->guard('api')->setUser($request->all())) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

     public function login1(Request $request)
    {
        $request->request->add([
            'grant_type' => 'password',
            'client_id' => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'username' => $request->username,
            'password' => $request->password,
            'scope' => '',
        ]);

        $tokenRequest = Request::create(
            env('APP_URL') . '/oauth/token',
            'post'
        );

        $response = app()->handle($tokenRequest);

        if ($response->getStatusCode() == 200) {
            return response()->json(json_decode((string) $response->getContent()), 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
