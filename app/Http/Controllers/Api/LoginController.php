<?php

namespace App\Http\Controllers\Api;

use App\Actions\Login\UserLoginAction;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
     *                 "mobile": "1111111111",
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

    public function login(Request $request)
    {
        $this->validate($request,[
            'mobile' => ['required','regex:/\b\d{10}\b/','exists:users'],
            'password'=>'required|regex:/\b\d{4}\b/',
            // 'password' => ['required',Password::min(8)->letters()->numbers()->symbols()]
        ]);

        return (new UserLoginAction($request))->handle();  
    }

    /**
     * @OA\Post(
     *   path="/social/login",
     *   tags={"Login"},
     *   operationId="Social media login",
     * summary="Social media Login",
     *   @OA\RequestBody(
     *      @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *             example={
     *                 "email": "social@media.login",
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

    public function socialLogin(Request $request)
    {
        return $request->all();
        // $this->validate($request,[
        //     'mobile' => ['required','regex:/\b\d{10}\b/','exists:users'],
        //     'password'=>'required|regex:/\b\d{4}\b/',
        //     // 'password' => ['required',Password::min(8)->letters()->numbers()->symbols()]
        // ]);

        // return (new UserLoginAction($request))->handle();  
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        // dd($user->email);
        $authUser = User::firstOrCreate(
            ['email'=>$user->email],
            [
            'name' => $user->name,
            'email' => $user->email,
            // 'google_id'=> $user->id,
            // 'image'=>$user->picture,
            'password' => encrypt('123456dummy')
        ]);
        $authUser->roles()->sync([2]);

        Auth::login($authUser, true);
        return response([
            'token'=>$user->token,
            'message'=> 'Logged in successfully',
            'profile'=> auth()->user()->roles
        ]);
    }


}
