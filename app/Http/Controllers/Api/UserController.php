<?php

namespace App\Http\Controllers\Api;

use App\Actions\Login\ResetPasswordAction;
use App\Actions\OTP\SendOtpAction;
use App\Actions\Profile\ProfileUpdateAction;
use App\Actions\ProfileUpdate;
use App\Http\Controllers\Admin\SuperController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserResource;
use App\Models\OtpVerification;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Collection\Collection as CollectionCollection;

class UserController extends SuperController
{
    public $whichModel;
    public $responseResource;

    public function __construct()
    {
        $this->whichModel = User::class;
        $this->responseResource = UserResource::class;
        parent::__construct($this->whichModel, $this->responseResource);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  
     /**
     * @OA\Get(
     *   path="/profile/view",
     *   tags={"User"},
     *   operationId="profile show",
     * summary="profile show",
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

    
    public function view()
    {
        return response()->json(['data'=>new ProfileResource (auth()->user())],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

      /**
     * @OA\Post(
     *      path="/profile/update",
     *      operationId="editProfile",
     *      tags={"User"},
     *      summary="Edit",
     *    @OA\RequestBody(
     *      @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *             example={
     *                 "name":"Roshan Shrestha",
     *                  "email":"email@gmail.com",
     *                   "username":"Rs", 
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
     
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users,email,'.auth()->id(),
            'username' => 'required|string|max:100',
            // 'mobile' => 'required|regex:/\b\d{10}\b/|exists:users',
            // 'password'=>'required|regex:/\b\d{4}\b/',
        ]);

        return (new ProfileUpdateAction($request))->handle();
    }

     /**
     * @OA\Post(
     *      path="/profile/change-password",
     *      operationId="change-password",
     *      tags={"User"},
     *      summary="change-password",
     *    @OA\RequestBody(
     *      @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *             example={
     *                 "current_password" : "2523",
     *                 "new_password" : "1234" 
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
    public function changePassword(Request $request)
    {
        $this->validate($request,[
            // 'current_password'=>'required|regex:/\b\d{4}\b/',
            'new_password'=>'required|regex:/\b\d{4}\b/',
        ]);
            $user = User::firstWhere('id',auth()->id());
            if(!Hash::check($request->current_password, $user->password)){
                return response()->json(['message' => 'Current password does not match.'], 400);
            }
                DB::beginTransaction();
            try{
                $user->update(['password'=>bcrypt($request->new_password)]);
                $user->tokens()->delete();
                $success['message'] = 'Password has been changed';
                $success['token'] = $user->createToken('MobileAuthApp')->accessToken;
                DB::commit();
                return response()->json($success, 200);
            }catch(\Exception $e)
            {
                $success['message'] = 'Failed to change password';
                DB::rollBack();
                return response()->json($success, 400);

            }
            
    }
 /**
     * @OA\Post(
     *      path="/profile/reset-password",
     *      operationId="reset-password",
     *      tags={"User"},
     *      summary="reset-password",
     *    @OA\RequestBody(
     *      @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *             example={
     *                 "mobile" : "9819087207",
     *                 "new_password" : "12347" 
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
    public function resetPassword(Request $request)
    {
        $this->validate($request,[
            'mobile' => 'bail|required|regex:/\b\d{10}\b/|exists:users',
            'new_password'=>'bail|required|size:4|regex:/\b\d{4}\b/',

        ]);
        return (new ResetPasswordAction($request))->handle(); 
    }

    
}
