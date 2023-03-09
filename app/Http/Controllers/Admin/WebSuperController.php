<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WebSuperController extends Controller
{
    public $whichModel;
    public $responseResource;
    public $directory;

    public function __construct($whichModel, $responseResource)
    {
        $this->whichModel = $whichModel;
        $this->responseResource = $responseResource;
        $this->directory = $this->whichModel::PERMISSIONSLUG;
    }
    public function getAllFieldNames()
    {
        $fillableFields = (new $this->whichModel())->getFillable();
        return $fillableFields;
        
    }

    public function index()
    {
        $data = $this->whichModel::all();
        return view('admin/'.$this->directory.'/index',compact('data'));
    }

    public function edit($id,$datas = array(null))
    {
        $data = $this->whichModel::find($id);
        return view('admin/'.$this->directory.'/edit',compact('data'),$datas);
    }

    public function storeFunction($request)
    {
        DB::beginTransaction();
        try {
            $model =  $this->whichModel::create($request->only($this->getAllFieldNames()));
            if (method_exists(new $this->whichModel(), 'afterCreateProcess')) {
                $model->afterCreateProcess();
            }

            DB::commit();
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

    public function updateFunction($request,$id)
    {        // dd($request->all());

           
        // $authUser = Auth::user();
        // $permissionSlug = $this->whichModel::PERMISSIONSLUG;
//        if (!$authUser->can('update-' . $permissionSlug)) {
//            throw new AccessDeniedException('unauthorized_access');
//        }
        DB::beginTransaction();
        try {

            $model = $this->whichModel::findOrFail($id)->update($request->only($this->getAllFieldNames()));

            if (method_exists(new $this->whichModel(), 'afterUpdateProcess')) {
                $model->afterUpdateProcess();
            }
            DB::commit();
            // return (new $this->responseResource($model))->response()->setStatusCode(200);
            return redirect()->back()->with('success','Record has been updated');


        } catch (\Exception $e) {
            DB::rollBack();
            // abort(500, $e);
            return redirect()->back()->with('error',$e->getMessage());

        }
    }

    public function create($data = array(null))
    {
        // $data = $this->whichModel::find($id);
        return view('admin/'.$this->directory.'/create',$data);   
    }

    public function delete($id)
    {
        $this->whichModel::find($id)->delete();
        return redirect()->back()->with('success','Record has been deleted');
    }
}
