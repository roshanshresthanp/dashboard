<?php

namespace App\Actions\Bucket;

use App\Models\Bucket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class BucketStoreAction
{
    use AsAction;

    public function handle(Request $request)
    {
        try{
            $user = auth()->id();
        //     DB::table('buckets')->updateOrInsert(
        //     ['cloth_id'=>$request->cloth_id,'user_id'=>$user],
        //     ['count'=>$request->count,'rate'=>$request->rate]
        // );

        Bucket::updateOrcreate(
            ['cloth_id'=>$request->cloth_id,'user_id'=>$user],
            ['count'=>$request->count,'rate'=>$request->rate]
        );

            return response()->json([
                'message' => $request->count.' item(s) have been added to your bucket.',
            ],200);

        }catch(\Exception $e)
        {
            return response()->json([
                'message' => 'Sorry we cannot add item at this moment',
            ],400);
        }
        

    }
}
