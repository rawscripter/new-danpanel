<?php

use App\Http\Controllers\MailController;
use App\Mail\ProductRequestMail;
use App\Order;
use App\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Auth::routes();

// to load admin dashboard
Route::get('/admin', function () {
    return view('admin.index');
});

// to load main site
Route::get('/', function () {
    return view('site.index');
});

// to load main site
Route::get('/login', function () {
    return view('site.index');
})->name('login');


// to test order mail
Route::get('/test/main', function () {
    $order = Order::find(249);
    MailController::sendMailToUserAtOrderPayment($order);
});


// to load main site
Route::get('/register', function () {
    return view('site.index');
});

//// to load main site
Route::get('/password/reset/{token}', function () {
    return view('site.index');
})->name('password.reset');

// Routes for PrivatePolikCookies, Handelsbetingelser og vilkår
Route::get('/handelsbetingelser', 'handelsbetingelserController@handelsbetingelser')->name('site.handelsbetingelser');
Route::get('/privatlivspolitikCookies', 'handelsbetingelserController@privatlivspolitikCookies')->name('site.privatlivspolitikCookies');

// for payment
Route::get('/checkout/payment/status', 'PaymentController@storePaymentDetails');


Route::post('sociallogin/{provider}', 'AuthController@SocialSignup');
Route::get('auth/{provider}/callback', 'OutController@index')->where('provider', ' .*');


Route::get('/{any}', function (\Illuminate\Http\Request $request) {
    if ($request->is('admin/*')) {
        return view('admin.index');
    }
    return view('site.index');
});


Route::get('/{any}/{any1}', function (\Illuminate\Http\Request $request) {
    if ($request->is('admin/*')) {
        return view('admin.index');
    }
    return view('site.index');
});

Route::get('/{any}/{any1}/{any2}', function (\Illuminate\Http\Request $request) {
    if ($request->is('admin/*')) {
        return view('admin.index');
    }
    return view('site.index');
});

Route::get('/{any}/{any1}/{any2}/{any3}', function (\Illuminate\Http\Request $request) {
    if ($request->is('admin/*')) {
        return view('admin.index');
    }
    return view('site.index');
});

