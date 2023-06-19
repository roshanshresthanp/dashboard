<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
     /**
     * @OA\Get(
     *   path="/my-activity",
     *   tags={"Activity Log"},
     *   operationId="Activity list",
     * summary="activity List",
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function myActivity()
    {
        return auth()->user()->activity()->paginate(20);
    }
}
