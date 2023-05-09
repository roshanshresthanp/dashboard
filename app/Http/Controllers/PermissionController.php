<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\WebSuperController;
use App\Http\Requests\PermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PermissionController extends WebSuperController
{
    public $whichModel;
    public $responseResource;

    public function __construct()
    {
        $this->whichModel = Permission::class;
        $this->responseResource = PermissionResource::class;
        parent::__construct($this->whichModel, $this->responseResource);
    }

    public function store(PermissionRequest $request)
    {
        return parent::storeFunction($request);
    }

    public function update(PermissionRequest $request,$id)
    {
        // dd($id,'con');
        return parent::updateFunction($request,$id);
    }
}
