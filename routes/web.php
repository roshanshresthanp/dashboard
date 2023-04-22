<?php

use App\Http\Controllers\Admin\ClothTypeController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\PromoCodeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BucketController;
use App\Http\Controllers\PickTimeController;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\ServiceController;
use App\Services\WebPushNotification;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return view('admin.layouts.app');
})->middleware('auth');

Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function(){
    $data = [
        'title'=>'Dashboard',
        'body'=>'Welcome to the dashboard'
    ];
    
    $pushn = new WebPushNotification;
    $pushn->sendPushNotification($data,[auth()->user()->fcm_token]);

    return view('admin.layouts.app');
})->name('dashboard')->middleware('auth');

Route::get('/push-notification', function(){
    return view('welcome');
})->name('push-notificaiton');
Route::get('/test', [PushNotificationController::class, 'sendTest']);


Route::post('/store-token', [PushNotificationController::class, 'storeToken'])->name('store.token');
Route::post('/send-web-notification', [PushNotificationController::class, 'sendWebNotification'])->name('send.web-notification');

Route::group(['prefix' => 'pro','middleware'=>'auth'], function () {

    // Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
    // Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('buckets',[BucketController::class,'webIndex'])->name('buckets.index');
    Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('customers/all', [CustomerController::class, 'all'])->name('customers.all');
    Route::get('customers/fetch', [CustomerController::class, 'fetchCustomer'])->name('customers.fetch');
    Route::delete('customers/delete/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::resource('/cloth-types', ClothTypeController::class);
    Route::resource('/promo-codes', PromoCodeController::class);
    Route::resource('/pickup-times', PickTimeController::class);
    Route::resource('/services', ServiceController::class);



    Route::resource('/enquiries', EnquiryController::class)->only('index','store','create','show');
    Route::get('/enquiry-status/{enquiry_id}/{status}', [EnquiryController::class,'changeStatus'])->name('enquiries.status');
    // Route::


    Route::group(['prefix'=>'logs'], function () {
        Route::get('/sms',[LogController::class,'smsLog'])->name('smsLog');
        Route::get('/sms-resend',[LogController::class,'smsResend'])->name('sms.resend');

        Route::get('/emails',[LogController::class,'emailLog'])->name('emailLog');
        Route::get('/activity',[LogController::class,'activityLog'])->name('activityLog');


    });

  

    
   




});



Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


