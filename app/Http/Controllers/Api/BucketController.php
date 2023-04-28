<?php

namespace App\Http\Controllers\Api;

use App\Actions\Bucket\BucketStoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BucketRequest;
use App\Http\Resources\Api\BucketResource;
use Illuminate\Http\Request;

class BucketController extends Controller
{

      /**
     * @OA\Get(
     *   path="/bucket",
     *   tags={"Bucket"},
     *   operationId="Bucket Show",
     * summary=" Bucket Show",
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/

    public function index()
    {
        return BucketResource::collection(auth()->user()->buckets()->status()->get());
    }
    /**
     * @OA\Post(
     ** path="/bucket",
     *   tags={"Bucket"},
     *   summary="Add to bucket",
     *      @OA\RequestBody(
     *      @OA\MediaType(
     *         mediaType="multipart/form-data",
     *         @OA\Schema(
     *          @OA\Property(
     *                 property="cloth_id",
     *                 type="integer"
     *             ),
     *          @OA\Property(
     *                 property="cloth_category_id",
     *                 type="number"
     *             ),
     *          @OA\Property(
     *                 property="count",
     *                 type="number",
     *             ),
     *             
     *         )
     *     )
     *   ),
     *


     *   @OA\Response(
     *      response=200,
     *       description="Successful Registration",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function store(BucketRequest $request)
    {
        return (new BucketStoreAction)->handle($request);
    }
}
