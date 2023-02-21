<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
class SuperController extends Controller
{
    public $whichModel;
    public $responseResource;

    public function __construct($whichModel, $responseResource)
    {
        $this->whichModel = $whichModel;
        $this->responseResource = $responseResource;
    }

    public function getAllFieldNames()
    {
        $fillableFields = (new $this->whichModel())->getFillable();
        return $fillableFields;
    }

    public function index()
    {
        return $this->whichModel::paginate(20);
    }

    public function all()
    {
        // $authUser = Auth::user();
        $permissionSlug = $this->whichModel::PERMISSIONSLUG;
//        if (!$authUser->can('view-' . $permissionSlug)) {
//            throw new AccessDeniedException('unauthorized_access');
//        }
        // $all = $this->whichModel::initializer()->get();
        return $this->responseResource::collection($this->whichModel::all())
            ->response()
            ->setStatusCode(200);
    }

    public function createFunction(Request $request)
    {
        try {
            return $this->whichModel::create($request->only($this->getAllFieldNames()));
        } catch (\Exception $e){
            return $e;
        }
    }

    public function storeFunction(Request $request)
    {
        $authUser = Auth::user();
        $permissionSlug = $this->whichModel::PERMISSIONSLUG;
//        if (!$authUser->can('create-' . $permissionSlug)) {
//            throw new AccessDeniedException('unauthorized_access');
//        }
        DB::beginTransaction();
        try {
            $model = $this->createFunction($request);
            if (method_exists(new $this->whichModel(), 'afterCreateProcess')) {
                $model->afterCreateProcess();
            }

            DB::commit();
            if ($model instanceof $this->whichModel) {
                $response = (new $this->responseResource($model))->response()->setStatusCode(200);
                return $response;
            } else {
                return Response::json(array(
                    'code' => 400,
                    'message' => $model
                ), 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            // abort(500, $e);
            return Response::json(array(
                'code' => 500,
                'message' => 'Something went wrong'
            ), 500);
        }
    }

    public function updateModelFunction(Request $request, $id)
    {
            $model = $this->whichModel::findOrFail($id);
            $model->update($request->only($this->getAllFieldNames()));
            return $model;
    }


    public function updateFunction(Request $request, $id)
    {
        // $authUser = Auth::user();
        // $permissionSlug = $this->whichModel::PERMISSIONSLUG;
//        if (!$authUser->can('update-' . $permissionSlug)) {
//            throw new AccessDeniedException('unauthorized_access');
//        }
        DB::beginTransaction();
        try {
            $model = $this->updateModelFunction($request, $id);
            if (method_exists(new $this->whichModel(), 'afterUpdateProcess')) {
                $model->afterUpdateProcess();
            }
            DB::commit();
            return (new $this->responseResource($model))->response()->setStatusCode(200);

        } catch (\Exception $e) {
            DB::rollBack();
            abort(500, $e);

        }
    }

    public function delete(Request $request)
    {
        // dd($request->all());
        // $authUser = Auth::user();
        $permissionSlug = $this->whichModel::PERMISSIONSLUG;
//        if (!$authUser->can('delete-' . $permissionSlug)) {
//            throw new AccessDeniedException('unauthorized_access');
//        }
        $itemsToDelete = $request->get('delete_rows');
        foreach ($itemsToDelete as $item) {
            $model = $this->whichModel->find($item);
            if ($model) {
                $model->delete();
            }
        }
        return Response::json(array(
            'code' => 200,
            'message' => 'Deleted Successfully'
        ), 200);
    }


}
