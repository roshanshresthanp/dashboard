<?php

namespace App\Http\Controllers\Api;

use App\Actions\Login\UserLoginAction;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     *   path="/login",
     *   tags={"Auth"},
     *   operationId="login",
     * summary="Login",
     *   @OA\RequestBody(
     *      @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *             example={
     *                 "email": "test@email.com",
     *                 "password": "**********"
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
            'email' => 'required|email|max:50',
            'password' => ['required',Password::min(8)->letters()->numbers()->symbols()]
        ]);

        try {
            $user = User::where(['email'=>$request->email,'password'=>$request->password])->first();
            dd($user);
            if(!$user){
            return response()->json(['message' => 'Invalid email and password.'], 400);
            }

            if (auth()->guard('api')->setUser($user)){
              $success['token'] = auth()->user()->createToken('LaravelAuthApp')->accessToken;
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
