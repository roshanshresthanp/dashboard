<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\RoleController;
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

Route::middleware(['api','auth:api'])->get('/user', function (Request $request) {
    return auth()->user()->roles[0];
    // dd(auth()->user()->hasRole('Super Admin'));
});

Route::post('login',[LoginController::class,'login']);
Route::post('register',[RegisterController::class,'register']);




Route::get('/profile', function (Request $request) {
    // return 'dsdsd';
    return (new \App\Http\Resources\ProfileResource($request->user()))
        ->response()
        ->setStatusCode(200);
});

Route::get('/test', function () {
    return User::all();
});



Route::group([
    'middleware' => ['api', 'auth:api'],
    // 'namespace' => 'Api\V1', 'as' => 'api.'
], function () {

            Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index']);
            Route::get('all', [UserController::class, 'all']);
            // Route::post('export', [UserController::class, 'export']);
            Route::post('/', [UserController::class, 'store']);
            Route::post('delete', [UserController::class, 'delete']);
            Route::post('/{id}', [UserController::class, 'update']);
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



            Route::get('all', [UserController::class, 'all']);



// UserController
