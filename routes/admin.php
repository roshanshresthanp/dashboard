<?php

use App\Http\Controllers\Admin\ClothTypeController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\PromoCodeController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BucketController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PickTimeController;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\ServiceController;
use App\Models\User;
use App\Notifications\CommonNotification;
use App\Services\WebPushNotification;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::group(['prefix' => 'pro','middleware'=>['auth','verified']], function () {

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    // Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('buckets',[BucketController::class,'webIndex'])->name('buckets.index');
    
    // Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
    // Route::get('customers/all', [CustomerController::class, 'all'])->name('customers.all');
    // Route::get('customers/fetch', [CustomerController::class, 'fetchCustomer'])->name('customers.fetch');
    // Route::delete('customers/delete/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');


    Route::resources([
        'customers'=> CustomerController::class,
        // 'buckets'=> BucketController::class,

    ]);

    Route::group(['prefix'=>'buckets','as'=>'buckets.'], function () {
        Route::get('/',[BucketController::class,'index'])->name('index');


    });

    Route::get('users/all', [UserController::class, 'fetchAll'])->name('user.all');

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


// Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });


