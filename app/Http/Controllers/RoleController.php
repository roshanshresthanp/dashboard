<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\SuperController;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends SuperController
{

    public $whichModel;
    public $responseResource;

    public function __construct()
    {
        $this->whichModel = app(Role::class);
        $this->responseResource = RoleResource::class;
        parent::__construct($this->whichModel, $this->responseResource);
    }

    public function store(RoleRequest $request)
    {
        $request->merge(['slug'=>Str::slug($request->name)]);
        return parent::storeFunction($request);
    }

    public function update(RoleRequest $request)
    {
        return $request->all();
        $request->merge(['slug'=>Str::slug($request->name)]);
        return parent::storeFunction($request);
    }
}
