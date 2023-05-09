<?php

namespace App\Http\Controllers\Admin;

use App\Models\PromoCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PromoCodeRequest;
use App\Http\Resources\PromoCodeResource;

class PromoCodeController extends WebSuperController
{
    public $whichModel;
    public $responseResource;

    public function __construct()
    {
        $this->whichModel = PromoCode::class;
        $this->responseResource = PromoCodeResource::class;
        parent::__construct($this->whichModel, $this->responseResource);
    }
    
    public function store(PromoCodeRequest $request)
    {
        return parent::storeFunction($request);
    }

    public function update(PromoCodeRequest $request,$id)
    {
        return parent::updateFunction($request,$id);
    }
}
