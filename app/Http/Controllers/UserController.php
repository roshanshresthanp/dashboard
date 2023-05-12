<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\WebSuperController;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Mail\SendOtpMail;
use App\Mail\UserRegisteredMail;
use App\Models\Role;    
use App\Models\User;
use App\Notifications\UserRegistration;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

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
        // dd($this->whichModel::user()->with('roles')->get());
        $data = [
            'users' => $this->whichModel::user()->with('roles')->get(),
        ];
        return view('admin.users.index',$data);
    }

    public function fetchAll(Request $request)
    {
        $customers = DB::table('users')->limit(10000)->get();
        // $customers = User::limit(10000)->get();
        return DataTables::of($customers)->make(true);
    }

    public function store(UserRequest $request)
    {
        return $this->userStoreFunction($request);
    }

    public function userStoreFunction($request)
    {
        DB::beginTransaction();
        $pass = mt_rand(1000, 9999);
        $request->merge(['password'=>bcrypt($pass)]);
        try {
            $model =  $this->whichModel::create($request->only($this->getAllFieldNames()));
            if (method_exists(new $this->whichModel(), 'afterCreateProcess')) {
                $model->afterCreateProcess();
            }
            // event(new Registered($model));
            // Mail::to($model)->send(new UserRegisteredMail('2468'));
            DB::commit();
            $model->notify(new UserRegistration($model,$pass));
            if ($model instanceof $this->whichModel) {
                // $response = (new $this->responseResource($model))->response()->setStatusCode(200);
                return redirect()->back()->with('success','Record has been added');
            } else {
                return redirect()->back()->with('error',$model);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());

        }
    }

    public function create($data = array(null))
    {
        $data['roles'] = Role::select('id','name')->get();
        return parent::create($data);
    }

    public function edit($id, $datas = array(null))
    {
        $this->checkAccess($id);
        $datas = [
            'roles' => Role::select('id','name')->get()
        ];
        return parent::edit($id,$datas);
    }

    public function update(UserRequest $request,$id)
    {
        $this->checkAccess($id);
        return parent::updateFunction($request,$id);
    }

    public function checkAccess($id)
    {
        if (auth()->id() != $id) {
            abort(401);
       }
    }
   

   
}
