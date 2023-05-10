<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Datatable\CustomerGetAction;
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
        if($request->ajax()){

            return (new CustomerGetAction())->getCustomer($request);     
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
