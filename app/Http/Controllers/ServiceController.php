<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\WebSuperController;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends WebSuperController
{
    public $whichModel;
    public $responseResource;

    public function __construct()
    {
        $this->whichModel = Service::class;
        $this->responseResource = Service::class;
        parent::__construct($this->whichModel, $this->responseResource);
    }

    public function store(Request $request)
    {
        $this->validate($request,
        [
            'name'=>'required|string|max:50|unique:services,name',
        ]);
        $request->merge(['status'=>$request->status=='on' ? 1 : 0]);

        return parent::storeFunction($request);
        
    }

    public function update($id,Request $request)
    {
        $this->validate($request,
        [
            'name'=>'required|string|max:50|unique:services,name,'.$id,
        ]);
        $request->merge(['status'=>$request->status=='on' ? 1 : 0]);
        return parent::updateFunction($request,$id);
    }

     /**
     * @OA\Get(
     *   path="/services",
     *   tags={"Service"},
     *   operationId="Service list",
     * summary="Services List",
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

     public function apiServices()
     {
         $success['data'] = $this->whichModel::status()->get();
         return response()->json($success,200);
     }
}
