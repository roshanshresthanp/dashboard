<?php

namespace App\Http\Controllers\Api;

use App\Actions\Profile\ProfileUpdateAction;
use App\Actions\ProfileUpdate;
use App\Http\Controllers\Admin\SuperController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Ramsey\Collection\Collection as CollectionCollection;

class UserController extends SuperController
{
    public $whichModel;
    public $responseResource;

    public function __construct()
    {
        $this->whichModel = app(User::class);
        $this->responseResource = UserResource::class;
        parent::__construct($this->whichModel, $this->responseResource);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     *   path="/profile",
     *   tags={"User"},
     *   operationId="customer list",
     * summary="Customer List",
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


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Post(
     *      path="/users",
     *      operationId="storeUser",
     *      tags={"User"},
     *      summary="Store",
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */


    // public function store(CustomerRequest $request)
    // {
    //     return parent::storeFunction($request);
    // }

  
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
}
