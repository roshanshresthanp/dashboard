<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Response;


class CustomerController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = User::all();
    }

    public function all(Request $request)
    {
        // dd($request->filter);

        $filt = [];
        foreach(json_decode($request->filter) as $sea  => $val)
        {
            $filt[$sea] = $val;
        }
// dd($filt);
        
        

        $customers = User::user()
        ->when($filt['search'], function ($q) use($filt) {
            $q->where('name','LIKE','%'.$filt['search'].'%')
            ->orWhere('email','LIKE','%'.$filt['search'].'%');
               
            })
            ;

        $customers = $customers->when($filt['status'] == 0 || $filt['status'] == 1, function ($q) use($filt) {
                $q->where('status',(int)$filt['status']);    
            });

        
        return new CustomerResource($customers->paginate($filt['rowPerPage']??20)); 

        // return User::user()->paginate(4);
    }
    
    public function index(Request $request)
    {
        // dd('Hello');
        if($request->ajax()){

            $customers = User::customer()
                        ->when($request->has('status') && $request->status != null , function($query) use ($request){
                            return $query->where('status',$request->status);
                     })
                        ->withCount('buckets');


            return DataTables::of($customers)
                ->addIndexColumn()
                // ->filter(function($instance) use ($request){
                //     return $instance->when($request->has('status') && $request->status != null , function($query) use ($request){
                //         return $query->where('status',$request->status);
                //         });
                // })

                ->editColumn('image', function($row){
                    return "<img src='$row->image' style='height:45px;width:45px;'>";
                })
                ->editColumn('status', function ($row){
                    if($row->status == 1){
                        return "<span class='badge badge-success'>Active</span";
                    }
                        return "<span class='badge badge-danger'>InActive</span>";

                })
                ->editColumn('bucket', function ($row){
                    return $row->buckets_count;
                })
                ->editColumn('order', function ($row){
                    return 'hudaicha';

                })
                ->editColumn('spent', function ($row){
                    return 'hudaicha';

                })
                ->editColumn('created_at', function ($row){
                    return $row->created_at;

                })
                ->editColumn('actions', function ($row) {
                    return '<form action="' . route('customers.destroy', $row->id) . '" method="post">' .
                        // '<a href="' . route('customers.edit', $row->id) . '"><i class="btn btn-sm btn-light fa fa-edit"></i></a>' .
                        '<input type="hidden" name="_token" value="' . csrf_token() . '">' .
                        '<input type="hidden" name="_method" value="DELETE">' .
                        '<button onclick="return confirm(\'Do you want to delete?\')" title="Delete" type="submit" class="btn btn-sm btn-light">' .
                        '<i class="fa fa-minus-circle" style="color:red"></i>' .
                        '</button>' .
                        '</form>';
                })
                ->rawColumns(['image','status','actions','spent'])
                ->make(true);        
            }
        return view('admin.customers.index1');
    }

    public function fetchCustomer(Request $request)
    {

        // $customers = DB::table('users')
        // ->join('model_has_roles', function($join) {
        //     $join->on('users.id','=','model_has_roles.model_id')
        //         ->where('model_has_roles.role_id','=',2);
        // })->select('users.name','users.id','users.email','users.status','users.mobile','model_has_roles.*')
        // // ->limit(10)
        // ->get();

//         $customers = DB::select(DB::raw("
//     SELECT users.name, users.id, users.email, users.status, users.mobile, model_has_roles.*
//     FROM users
//     JOIN model_has_roles ON users.id = model_has_roles.model_id AND model_has_roles.role_id = 2
// "));
        // $customers = DB::table('users')->get();

           
    }

//     public function delete(Request $request)
//     {
//         // dd($request->all());
//         // $authUser = Auth::user();
//         $permissionSlug = $this->whichModel::PERMISSIONSLUG;
// //        if (!$authUser->can('delete-' . $permissionSlug)) {
// //            throw new AccessDeniedException('unauthorized_access');
// //        }
//         $itemsToDelete = $request->get('delete_rows');
//         foreach ($itemsToDelete as $item) {
//             $model = $this->whichModel->find($item);
//             if ($model) {
//                 $model->delete();
//             }
//         }
//         return Response::json(array(
//             'message' => 'Deleted Successfully'
//         ), 200);
//     }

    public function destroy($id)
    {
        $this->model->find($id)->delete();
        return redirect()->back()->with('success','Record deleted successfully');

            //     return Response::json(array(
            //     'message' => 'Record deleted successfully'
            // ), 200);
    }
}
