<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\SuperController;
use App\Http\Controllers\Controller;
use App\Http\Resources\PromoCodeResource;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends SuperController
{
    public $whichModel;
    public $responseResource;

    public function __construct()
    {
        $this->whichModel = PromoCode::class;
        $this->responseResource = PromoCodeResource::class;
        parent::__construct($this->whichModel, $this->responseResource);
    }

    /**
     * @OA\Get(
     *   path="/promo-codes",
     *   tags={"promo-codes"},
     *   operationId="promo-codes list",
     * summary="Promo List",
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
    public function create()
    {
        
    }
    
   
}
