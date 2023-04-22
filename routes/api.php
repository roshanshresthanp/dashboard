<?php

use App\Http\Controllers\Api\ClothTypeController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PromoCodeController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\BucketController;
use App\Http\Controllers\PickTimeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * @OA\Info(
 *     title="My API",
 *     version="1.0.0",
 *     description="My API description",
 * )
 */

// Route::middleware(['api','auth:api'])->get('/user', function (Request $request) {

//     return auth()->user();
// });

Route::post('login',[LoginController::class,'login']);
Route::post('register',[RegisterController::class,'register']);

Route::get('/profile', function (Request $request) {
    // return 'dsdsd';
    return (new \App\Http\Resources\ProfileResource($request->user()))
        ->response()
        ->setStatusCode(200);
});



Route::group([
    'middleware' => ['api', 'auth:api'],
    // 'namespace' => 'Api\V1', 'as' => 'api.'
], function () {

    Route::get('pickup-time',[PickTimeController::class,'apiPickupTime']);
    Route::get('services',[ServiceController::class,'apiServices']);
    Route::get('cloth-category',[ClothTypeController::class,'category']);
    Route::apiResource('cloth-types',ClothTypeController::class);
    Route::apiResource('offers',PromoCodeController::class);
    Route::post('use/offer',[PromoCodeController::class,'useOffer']);
    Route::get('use/offer',[PromoCodeController::class,'assignedOffer']);
    // Route::get('buckets',[BucketController::class,'webIndex'])->name('buckets.index');

        Route::group(['prefix' => 'profile'], function () {
            Route::post('/update', [UserController::class, 'update']);
            Route::get('/view', [UserController::class, 'view']);

            // Route::post('/{id}/reset-password', [UserController::class, 'resetPassword']);
        });

        Route::group(['prefix' => 'roles'], function () {
            Route::get('/', [RoleController::class, 'index']);
            Route::get('all', [RoleController::class, 'all']);
            // Route::post('export', [RoleController::class, 'export']);
            Route::post('/', [RoleController::class, 'store']);
            Route::post('delete', [RoleController::class, 'delete']);
            Route::post('/{id}', [RoleController::class, 'update']);
            // Route::post('/{id}/reset-password', [RoleController::class, 'resetPassword']);

        });
});
