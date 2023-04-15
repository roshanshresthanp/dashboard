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

    public function __construct()
    {
        $this->whichModel = ClothType::class;
        $this->responseResource = ClothTypeResource::class;
        parent::__construct($this->whichModel, $this->responseResource);
    }

    /**
     * @OA\Get(
     *   path="/cloth-category",
     *   tags={"Cloth"},
     *   operationId="category with list",
     * summary="Category with cloth List",
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

    public function category()
    {
        // $success['data'] = $this->whichModel::category()->status()->with('clothes')->get();
        // return response()->json($success, 200);

        return $this->responseResource::collection($this->whichModel::category()->status()->get())
            ->response()
            ->setStatusCode(200);
    }
     /**
     * @OA\Get(
     *   path="/cloth-types",
     *   tags={"Cloth"},
     *   operationId="cloth-types list",
     * summary="Cloth  List",
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

    public function index()
    {
        $success['data'] = $this->whichModel::cloth()->status()->select('id','name','rate')->get();
        return response()->json($success, 200);
    }


    

    
}
