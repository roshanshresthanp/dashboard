<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClothTypeRequest;
use App\Http\Resources\ClothTypeResource;
use App\Models\ClothType;
use Illuminate\Http\Request;

class ClothTypeController extends WebSuperController
{
    public $whichModel;
    public $responseResource;

    public function __construct()
    {
        $this->whichModel = ClothType::class;
        $this->responseResource = ClothTypeResource::class;
        parent::__construct($this->whichModel, $this->responseResource);
    }

    public function create($data = array(null))
    {
        $data = [
            'category' => $this->whichModel::where('parent_id',NULL)->select('id','name')->get(), 
        ];
        return parent::create($data);
    }

    public function edit($id,$data = array(null))
    {
        $data = [
            'category' => $this->whichModel::where('parent_id',NULL)->get(), 
        ];
        return parent::edit($id,$data);
    }

    public function store(ClothTypeRequest $request)
    {
        return parent::storeFunction($request);
    }

    public function update(ClothTypeRequest $request,$id)
    {
        return parent::updateFunction($request,$id);
    }
}
