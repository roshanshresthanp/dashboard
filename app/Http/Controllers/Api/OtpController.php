<?php

namespace App\Http\Controllers\Api;

use App\Actions\OTP\SendOtpAction;
use App\Actions\OTP\VerifyOtpAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtpController extends Controller
{
      /**
     * @OA\Post(
     *      path="/otp/send",
     *      operationId="otp send",
     *      tags={"OTP"},
     *      summary="otp send",
     *    @OA\RequestBody(
     *      @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *             example={
     *                 "mobile" : "9810497636",
     *              }
     *         )
     *     )
     *   ),
     *  *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *      ),
     *     )
     */
    public function sendOtp(Request $request)
    {
        $this->validate($request,[
            'mobile' => 'required|regex:/\b\d{10}\b/',
        ]);
        return (new SendOtpAction($request))->handle();    
    }

     /**
     * @OA\Post(
     *      path="/otp/verify",
     *      operationId="otp verify",
     *      tags={"OTP"},
     *      summary="otp verify",
     *    @OA\RequestBody(
     *      @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *             example={
     *                 "mobile" : "9810497636",
     *                  "otp" : "1234"
     *              }
     *         )
     *     )
     *   ),
     *  *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *      ),
     *     )
     */

    public function verifyOtp(Request $request)
    {
        $this->validate($request,[
            'mobile' => ['required','regex:/\b\d{10}\b/'],
            'otp'=>'required|regex:/\b\d{4}\b/',
        ]);
        return (new VerifyOtpAction())->handle($request);
    }
}
