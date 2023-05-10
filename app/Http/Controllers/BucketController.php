<?php

namespace App\Http\Controllers;

use App\Models\Bucket;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class BucketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         // dd('Hello');
         if($request->ajax()){

            $buckets = Bucket::all();
            // when($request->has('status') && $request->status != null , function($query) use ($request){
            //                 return $query->where('status',$request->status);
            //          });
            return DataTables::of($buckets)
                ->addIndexColumn()
                ->editColumn('image', function($row){
                    return '<img src='.$row->cloth->image.' style="height:45px;width:45px;">';
                })
                ->editColumn('customer', function ($row){
                    return $row->customer->name;

                })
                ->editColumn('cloth', function ($row){
                    return $row->cloth->name;

                })
                ->editColumn('rate', function ($row){
                    return $row->cloth->rate;

                })
                ->editColumn('amount', function ($row){
                    return $row->cloth->rate*$row->count;

                })
                ->editColumn('service', function ($row){
                    return 'wash';

                })
                ->editColumn('created_at', function ($row){
                    return $row->created_at;

                })
                // ->editColumn('actions', function ($row) {
                //     return '<form action="' . route('customers.destroy', $row->id) . '" method="post">' .
                //         // '<a href="' . route('customers.edit', $row->id) . '"><i class="btn btn-sm btn-light fa fa-edit"></i></a>' .
                //         '<input type="hidden" name="_token" value="' . csrf_token() . '">' .
                //         '<input type="hidden" name="_method" value="DELETE">' .
                //         '<button onclick="return confirm(\'Do you want to delete?\')" title="Delete" type="submit" class="btn btn-sm btn-light">' .
                //         '<i class="fa fa-minus-circle" style="color:red"></i>' .
                //         '</button>' .
                //         '</form>';
                // })
                ->rawColumns(['image','cloth','customer','rate','amount','service'])
                ->make(true);        
            }
        return view('admin.buckets.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    

    public function store(Request $request)
    {
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bucket  $bucket
     * @return \Illuminate\Http\Response
     */
    public function show(Bucket $bucket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bucket  $bucket
     * @return \Illuminate\Http\Response
     */
    public function edit(Bucket $bucket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bucket  $bucket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bucket $bucket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bucket  $bucket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bucket $bucket)
    {
        //
    }
}
