<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\SuperController;
use App\Http\Controllers\Controller;
use App\Http\Resources\PromoCodeResource;
use App\Models\PromoCode;
use Illuminate\Http\Request;
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

    
   
}
