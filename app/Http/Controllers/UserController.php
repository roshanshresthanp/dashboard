<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function customers()
    {
        $data = [
            'customers'=>User::customer()->get(),
        ];

        return view('admin.customers.index',$data);
    }

    public function fetchCustomers(Request $request)
    {
        dd($request->all());
        $data = [
            'customers'=>User::customer()->get(),
        ];

        return $data;
        // return view('admin.customers.index',$data);
    }

    public function index()
    {
        return view('admin.users.index');
    }
}
