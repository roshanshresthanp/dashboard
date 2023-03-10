<?php

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
});

Route::group(['prefix' => 'pro'], function () {

    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('customers', [UserController::class, 'customers'])->name('customers.index');
    Route::post('customers', [UserController::class, 'fetchCustomers'])->name('customers.fetch');


    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);


});


