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
                $req = $this->request->only(['name','email','address','username','image']);
                $model = auth()->user()->update($req);
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