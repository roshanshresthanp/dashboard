<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\WebSuperController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


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
        // $data = [
        //     'users' => User::all(),
        // ];

        // dd($data['users']);
        return view('admin.users.index1');
    }

    public function fetchAll(Request $request)
    {
        $customers = DB::table('users')->get();
        return DataTables::of($customers)->toJson();
    }
}
