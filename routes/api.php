<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware(['api','auth:api'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[LoginController::class,'login']);

//-----------Email Verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



Route::get('/profile', function (Request $request) {
    // return 'dsdsd';
    return (new \App\Http\Resources\ProfileResource($request->user()))
        ->response()
        ->setStatusCode(200);
});
Route::get('/test', function () {
    dd('dsdsd');
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
});


// UserController
