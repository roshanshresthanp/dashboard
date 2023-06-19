<?php 

namespace App\Actions\Profile;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Lorisleiva\Actions\Concerns\AsAction;


final class ProfileUpdateAction{

    // use AsAction;
    
    protected $request;
    function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function handle()
    {
        DB::beginTransaction();
        try {
                $req = $this->request->except(['email','username']);
                $model = auth()->user();
                $udateUser = $model->update($req);

                $model->profile()->update([
                    'temporary_address' =>$this->request->temporary_address,
                    'permanent_address' =>$this->request->permanent_address,
                    'latitude' =>$this->request->latitude,
                    'longitude' =>$this->request->longitude,
                    'gender' =>$this->request->gender,
        
                ]);
                DB::commit();
    
                return response()->json(array(
                    'message' => 'Profile updated successfully',
                ), 200);

            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(array(
                    // 'message' =>'Profile update failed',
                    'message' => $e->getMessage(),

                ), 400);
            }
            
        }
    
   
        

}