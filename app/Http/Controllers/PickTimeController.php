<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\WebSuperController;
use App\Http\Resources\PickUpTimeResource;
use App\Models\PickTime;
use Illuminate\Http\Request;


class PickTimeController extends WebSuperController
{


    public $whichModel;
    public $responseResource;

    public function __construct()
    {
        $this->whichModel = PickTime::class;
        $this->responseResource = PickUpTimeResource::class;
        parent::__construct($this->whichModel, $this->responseResource);
    }

    public function store(Request $request)
    {
        $this->validate($request,
        [
            'time'=>'required|date_format:H:i|unique:pick_times,time'
        ]);
        $request->merge(['status'=>$request->status=='on' ? 1 : 0]);
        // dd($request->all());

        return parent::storeFunction($request);
    }

    public function update($id,Request $request)
    {       


        $this->validate($request,
        [
            'time'=>'required|unique:pick_times,time,'.$id
        ]); 
        $request->merge(['status'=>$request->status=='on' ? 1 : 0]);
        // dd($request->all());

        return parent::updateFunction($request,$id);

    }

    /**
     * @OA\Get(
     *   path="/pickup-time",
     *   tags={"PickUp time"},
     *   operationId="pickup list",
     * summary="pickup time List",
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

    public function apiPickupTime()
    {
        $success['data'] = PickTime::status()->get();
        return response()->json($success,200);
    }
}
