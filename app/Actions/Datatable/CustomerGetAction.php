<?php

namespace App\Actions\Datatable;

use App\Models\User;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Yajra\DataTables\DataTables;

class CustomerGetAction
{
    use AsAction;

    public function getCustomer(Request $request)
    {
        $customers = User::customer()
        ->when($request->has('status') && $request->status != null , function($query) use ($request){
            return $query->where('status',$request->status);
        })
        ->when($request->has('date') && $request->date != null, function($query) use($request){
                    $dateStrings = explode(' / ', $request->date);
                    $start = strtotime($dateStrings[0]);
                    $end = strtotime($dateStrings[1]);

                return $query->whereBetween('created_at',[date('Y-m-d H:i:s',$start),date('Y-m-d H:i:s',$end)]);

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
}
