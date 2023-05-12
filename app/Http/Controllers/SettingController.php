<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class SettingController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = Setting::class;
    }
    public function create()
    {
        return view('admin.settings.create');
    }
    public function store(Request $request)
    {
        try{
            foreach($request->key as $key=>$val){
                $this->model::create([
                    'key'=>$val,
                    'slug'=>Str::slug($val),
                    'value'=>$request->value[$key],
                    'image'=>null
                ]);
            }
            return redirect()->back()->with('success','Company Settings have been added');

        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
    public function index(){
        $settings = $this->model::all();
        return view('admin.settings.edit',compact('settings'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        foreach($request->except('_method','_token') as $keyId=>$val)
        {
            DB::table('settings')->where('id',$keyId)->update([
                    'slug'=>Str::slug($val),
                    'value'=>$val
            ]);
        }
        return redirect()->back()->with('success','Company Settings have been updated');
    }

    public function destroy($id)
    {
        $this->model::find($id)->delete();
        return redirect()->back()->with('success','Record has been deleted');
    }
}
