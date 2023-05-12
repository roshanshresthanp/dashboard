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
use App\Http\Controllers\PickTimeController;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\ServiceController;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\CommonNotification;
use App\Notifications\UserRegistration;
use App\Services\WebPushNotification;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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
Route::get('auth/google', [LoginController::class,'redirectToGoogle']);
Route::get('auth/google/callback', [LoginController::class,'handleGoogleCallback'])->name('googleCallback');

Route::get('/', function(){
    // return view('admin.layouts.app');
    // return view('welcome');

    return redirect()->route('dashboard');
})->middleware('auth');

Auth::routes(['register' => false]);



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/dashboard', function(){
//     $data = [
//         'title'=>'Dashboard',
//         'body'=>'Welcome to the dashboard'
//     ];
    
//     $pushn = new WebPushNotification;
//     $pushn->sendPushNotification($data,[auth()->user()->fcm_token]);

//     return view('admin.layouts.app');
// })->name('push.dashboard')->middleware('auth');

Route::get('/push-notification', function(){
    return view('welcome');
})->name('push-notificaiton');

Route::get('/test', [PushNotificationController::class, 'sendTest']);

Route::get('/notification',function(){
    $user = User::find(auth()->id());
    $user->notify(new UserRegistration($user,'456' ));
    // User::find(auth()->user()->id)->notify(new CommonNotification('Your notified'));
});


Route::post('/store-token', [PushNotificationController::class, 'storeToken'])->name('store.token');
Route::post('/send-web-notification', [PushNotificationController::class, 'sendWebNotification'])->name('send.web-notification');


Route::get('/email/verify', function () {
    if(auth()->user()->email_verified_at != null){
        return redirect('pro/dashboard')->with('success','Welcome !! Your email has been verified 🫠 ');
    }
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('dashboard')->with('message','Thanks for verifying your email.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



// Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });


Route::get('/try', function(){
    dd(Setting::all()->pluck('value','key'));

});