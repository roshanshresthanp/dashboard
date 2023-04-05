<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\WebSuperController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends WebSuperController
{
    public $whichModel;
    public $responseResource;

    public function __construct()
    {
        $this->whichModel = User::class;
        $this->responseResource = UserResource::class;
        parent::__construct($this->whichModel, $this->responseResource);
    }

    public function index()
    {
        $data = [
            'users' => User::first()->hasRoles[0],
        ];

        dd($data['users']);
        return view('admin.users.index',$data);
    }
}
