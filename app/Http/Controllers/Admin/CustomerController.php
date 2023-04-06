<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\User;
use Illuminate\Http\Request;
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

        $customers = User::
        select('id','name','email','status','mobile')
        
        ->when($filt['status'] == 0 || ($filt['status'] == 1), function ($q) use($filt) {
            $q->where('status',(int)$filt['status']);    
        })

        ->when($filt['search'], function ($q) use($filt) {
            $q->where('name','LIKE','%'.$filt['search'].'%')
            ->orWhere('email','LIKE','%'.$filt['search'].'%');
               
            });

        $customers = $customers->paginate($filt['rowPerPage']);
        
        return new CustomerResource($customers);
    }
    
    public function index(Request $request)
    {
        // if($request->ajax()){
        //     dd($request->wantsJson()
        // );
        //     return new CustomerResource(User::customer()->paginate(10));
        // }
        // $data = [
        //     'customers'=>User::customer()->get(),
        // ];

        return view('admin.customers.index');
    }

    public function fetchCustomer(Request $request)
    {
            $customers = User::all();
     
        return DataTables::of($customers)->toJson();
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
        $del = $this->model->find($id)->delete();

                return Response::json(array(
                'message' => 'Record deleted successfully'
            ), 200);
    }
}
