<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\SuperController;
use App\Http\Controllers\Controller;
use App\Http\Resources\PromoCodeResource;
use App\Models\PromoCode;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class PromoCodeController extends SuperController
{
    public $whichModel;
    public $responseResource;

    /**
     * @OA\Get(
     *   path="/offers",
     *   tags={"Offers"},
     *   operationId="offers list",
     * summary="offers List",
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

    public function __construct()
    {
        $this->whichModel = PromoCode::class;
        $this->responseResource = PromoCodeResource::class;
        parent::__construct($this->whichModel, $this->responseResource);
    }

    /**
     * @OA\Get(
     *   path="/offers/{id}",
     *   tags={"Offers"},
     *   operationId="offers show",
     * summary="offers show",
     *
     * @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer",
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/

     public function show($id)
     {
        $success['data'] = $this->whichModel::find($id);
        return response()->json($success, 200);
     }

     /**
     * @OA\Post(
     *   path="/use/offer",
     *   tags={"Offers"},
     *   operationId="offers assign",
     * summary="offers assign",
     *
   *    @OA\RequestBody(
   *      @OA\MediaType(
   *         mediaType="application/json",
   *         @OA\Schema(
   *             example={
   *                 "promo_code": "test"
   *              }
   *         )
   *     )
   *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/

     public function useOffer(Request $request)
     {   
      $this->validate($request,[
         'promo_code'=>'required|string|exists:promo_codes,code'
      ]);
      $user = auth()->user();

         $pc = DB::table('promo_codes')->where('code',$request->promo_code)->first();
         $expire = $pc->expire_date;

         $nowDate = Carbon::parse(now()->timezone('Asia/Kathmandu'))->format("Y-m-d H:i:s");
      if($nowDate > $expire){
         return response()->json(['message' => 'The selected promo code is expired.'], 400);
      }

      if(DB::table('customer_promo')->where(['user_id'=>$user->id,'promo_id'=>$pc->id])->first()){
         return response()->json(['message' => 'You have already entered this promo code.'], 400);
      }

      $user->promo()->attach([$pc->id]);
         $success['message'] = 'Promo code has been added';
         return response()->json($success, 200);
     }

    
   
}
