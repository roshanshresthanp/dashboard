<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnquiryRequest;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends WebSuperController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $whichModel;
    public $responseResource;

    public function __construct()
    {
        $this->whichModel = Enquiry::class;
        $this->responseResource = Enquiry::class;
        parent::__construct($this->whichModel, $this->responseResource);
    }

    public function store(EnquiryRequest $request)
    {
        return parent::storeFunction($request);
    }
    public function changeStatus($id,$status)
    {
        // dd($id,$status);
        try{
            $this->whichModel::find($id)->update(['status'=>$status]);
            return redirect()->back()->with('success','Status changes successfully');
        }catch(\Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
