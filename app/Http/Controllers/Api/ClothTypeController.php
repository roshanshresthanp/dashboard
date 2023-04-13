<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\SuperController;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClothTypeResource;
use App\Models\ClothType;
use Illuminate\Http\Request;

class ClothTypeController extends SuperController
{
    public $whichModel;
    public $responseResource;


     /**
     * @OA\Get(
     *   path="/cloth-types",
     *   tags={"cloth-types"},
     *   operationId="cloth-types list",
     * summary="Cloth List",
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
        $this->whichModel = ClothType::class;
        $this->responseResource = ClothTypeResource::class;
        parent::__construct($this->whichModel, $this->responseResource);
    }

    

    // public function index()
    // {
        
    // }


    

    
}
