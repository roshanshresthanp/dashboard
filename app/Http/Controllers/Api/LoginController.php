<?php

namespace App\Http\Controllers\Api;

use App\Actions\Login\UserLoginAction;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     *   path="/login",
     *   tags={"Login"},
     *   operationId="login",
     * summary="Login",
     *   @OA\RequestBody(
     *      @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *             example={
     *                 "mobile": "9800000000",
     *                 "password": "****"
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

    public function login(Request $request)
    {

        $this->validate($request,[
            'mobile' => ['required','string','size:10'],
            // 'password' => ['required',Password::min(8)->letters()->numbers()->symbols()]
        ]);

        // return $request->all();
        try {
            $user = User::firstWhere(['mobile'=>$request->mobile]);

            // if(!$user || !Hash::check($request->password, $user->password)){
            //     return response()->json(['message' => 'Invalid email and password.'], 400);
            // }
            // dd('dsds');
            // if (Hash::check($request->password, $user->password)) {
            //     dd('pass matched');
            // }


            if (auth()->guard('api')->setUser($user)){
            // if (auth()->check(['email'=>$request->email,'password'=>$request->password])){

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
