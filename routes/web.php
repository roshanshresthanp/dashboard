<?php

use App\Http\Controllers\Admin\ClothTypeController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\PromoCodeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    // dd('for web');
    return '.....Backend is working.....';
    // return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function(){
    return view('admin.layouts.app');
})->name('dashboard');

Route::group(['prefix' => 'pro'], function () {

    // Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
    // Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('customers/all', [CustomerController::class, 'all'])->name('customers.all');
    Route::get('customers/fetch', [CustomerController::class, 'fetchCustomer'])->name('customers.fetch');
    Route::delete('customers/delete/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::resource('/cloth-types', ClothTypeController::class);
    Route::resource('/promo-codes', PromoCodeController::class);

    Route::group(['prefix'=>'logs'], function () {
        Route::get('/sms',[LogController::class,'smsLog'])->name('smsLog');
        Route::get('/emails',[LogController::class,'emailLog'])->name('emailLog');
        Route::get('/activity',[LogController::class,'activityLog'])->name('activityLog');


    });




});


