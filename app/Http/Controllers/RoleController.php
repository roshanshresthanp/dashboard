<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\WebSuperController;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Middlewares\RoleMiddleware;

class RoleController extends WebSuperController
{

    public $whichModel;
    public $responseResource;

    public function __construct()
    {
        $this->whichModel = Role::class;
        $this->responseResource = RoleResource::class;
        parent::__construct($this->whichModel, $this->responseResource);
    }

    public function store(RoleRequest $request)
    {   
        return parent::storeFunction($request);
    }
    
    public function update(RoleRequest $request,$id)
    {
        return parent::updateFunction($request,$id);
    }

    public function edit($id, $datas = array(null))
    {
        $datas['permissions'] = Permission::all();
        return parent::edit($id,$datas);
    }

    public function create($datas = array(null))
    {
        $datas['permissions'] = Permission::all();
        return parent::create($datas);
    }

}
