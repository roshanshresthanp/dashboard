<?php

namespace App\Http\Controllers\Api;

use App\Actions\Login\UserLoginAction;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


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


}
