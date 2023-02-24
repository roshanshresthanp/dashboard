<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PermissionController extends Controller
{
    public $whichModel;
    public $responseResource;

    public function __construct()
    {
        $this->whichModel = app(Permission::class);
        $this->responseResource = PermissionResource::class;
        parent::__construct($this->whichModel, $this->responseResource);
    }

    public function store(PermissionRequest $request)
    {
        $request->merge(['slug'=>Str::slug($request->name)]);
        return parent::storeFunction($request);
    }

    public function update(PermissionRequest $request)
    {
        $request->merge(['slug'=>Str::slug($request->name)]);
        return parent::updateFunction($request);
    }
}
