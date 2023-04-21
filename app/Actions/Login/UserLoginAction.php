<?php

namespace App\Actions\Login;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
// use Lorisleiva\Actions\Concerns\AsAction;

final class UserLoginAction
{
    // use AsAction;
    protected $request;

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        try {
            $user = User::firstWhere(['mobile'=>$this->request->mobile]);
            if(!Hash::check($this->request->password, $user->password)){
                return response()->json(['message' => 'Invalid email and password.'], 400);
            }

            if (auth()->guard('api')->setUser($user)){

                $success['message'] = "login success";
                $success['token'] = $user->createToken('MobileAuthApp')->accessToken;
                return response()->json($success, 200);
            } else {
                return response()->json(['message' => 'Invalid email and password.'], 400);
            }

        }catch (\ErrorException $e){
            return response()->json([
                'message' => 'Login failed',
                // 'errors'=>$e->getMessage()
            ],500);
            // return response()->json(['message' => 'Invalid email and password.'], 400);
        }
    }

}
