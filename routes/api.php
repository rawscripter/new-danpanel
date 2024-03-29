<?php

use App\Http\Controllers\PaymentController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/user', 'AuthController@user');
    Route::post('/user/update/password', 'AuthController@updatePassword');
    Route::get('/user/get/info', 'AuthController@getUserInfo');
    Route::post('/user/update/info', 'AuthController@updateInfo');
    // api for create new order
    Route::post('order/{order}/shipping/method/update', 'OrderController@updateShippingMethod');
//    Route::post('/payment/{order}/full-payment', 'PaymentController@createFullPaymentId');
    Route::get('/order/{orderId}/details', 'OrderController@orderDetails');
    Route::post('/logout', 'AuthController@logout');
});

//Route::post('order/shipping/save', 'OrderController@saveShippingInfo');
Route::post('/order/create', 'OrderController@createNewOrder');


// apis for admin
Route::group(['middleware' => ['auth:api'], 'prefix' => 'admin'], function () {
    Route::get('/dashboard/data', 'AdminDashboardController@adminDashboardData');
    Route::resource('/category', 'CategoryController');
    Route::get('/requests', 'ProductRequestController@requests');
    Route::get('/category/{category}/sub-categories', 'CategoryController@subCategories');

    Route::resource('/product', 'ProductController');
    Route::post('/blog/store', 'BlogController@store');
    Route::put('/blog/{blog}/update', 'BlogController@update');
    Route::resource('/blog', 'BlogController');

    Route::post('/page/store', 'PageController@store');
    Route::put('/page/{page}/update', 'PageController@update');
    Route::get('/page/{page}', 'PageController@show');
    Route::delete('/page/{page}', 'PageController@destroy');
    Route::get('/pages', 'PageController@index');

    Route::get('/products/archive', 'ProductController@archiveProducts');
    Route::post('/product/{product}/restore', 'ProductController@restore');
    Route::post('/product/{product}/archive', 'ProductController@archive');
    Route::post('/product/{product}/variation', 'ProductVariationController@store');
    Route::delete('/product/{productVariation}/variation', 'ProductVariationController@destroy');

    Route::post('/product/{product}/variation/option', 'ProductVariationController@addOption');
    Route::delete('/product/{productVariationOption}/variation/option', 'ProductVariationController@deleteVariationOption');


    Route::get('/orders', 'OrderController@orders');
    Route::get('/order/{order}/details', 'OrderController@orderDetails');

    Route::get('/customers', 'CustomerController@customers');


    Route::post('/product/{product}/upload/images', 'ProductController@uploadProductImages');
    Route::post('/package/product/{product}/upload/images', 'ProductController@uploadPackageProductSliderImages');
    Route::post('/image/upload', 'ImageController@uploadRawImage');
    Route::post('/product-image/{imageId}/delete', 'ProductController@deleteProductImage');
    Route::resource('/sub-category', 'SubCategoryController');

    Route::post('/order/{order}/resend-mail', 'OrderController@resendPaymentOrderMail');
});

// apis for customer
Route::group(['middleware' => ['auth:api'], 'prefix' => 'customer'], function () {
    Route::get('/orders', 'OrderController@customerOrders');
    Route::get('/dashboard/data', 'CustomerDashboardController@adminDashboardData');
    Route::get('/product/{eventID}/graph', 'GraphController@priceFallGraph');
});

Route::get('/user/total/favourites', 'ProductController@userFavourites');


// apis for site
Route::get('/categories', 'CategoryController@index');
Route::get('/products', 'ProductController@productsForSite');
Route::get('/running/products', 'ProductController@runningProducts');
Route::get('/package/products', 'ProductController@packageProducts');
Route::get('/request/products', 'ProductController@requestProducts');


Route::get('/favourites', 'ProductController@userFavouriteProductsForSite');
Route::get('/reminders-events', 'ProductController@userReminderProductsForSite');
Route::get('/product/{slug}', 'ProductController@showProductForSite');

// favourite list
Route::get('/product/{slug}/like/add', 'ProductController@addToLike');
Route::get('/product/{slug}/favourite/add', 'ProductController@addToFavourite');
Route::get('/product/{slug}/reminder/add', 'ProductReminderController@store');


Route::get('/product/{slug}/favourite/remove', 'ProductController@removeFromFavourite');
Route::post('/product/{slug}/make/request', 'ProductRequestController@store');
Route::get('/max/product/price', 'ProductController@maxProductPrice');


Route::get('/product/{slug}/related-products', 'ProductController@showRelatedForSite');
Route::get('/category/{categorySlug}/products', 'CategoryController@products');
Route::get('/sub-category/{categorySlug}/products', 'SubCategoryController@products');
Route::get('/category/{categorySlug}/sub-categories', 'CategoryController@subCategoriesForSite');
// for gls posts for user shipping method
Route::post('/gls/shops', 'GlsController@getShops');;


//routes for blogs

Route::get('/blogs', 'BlogController@getBlogs');
Route::get('/get/blog/sub-categories', 'BlogController@getBlogCategories');
Route::get('/get/pages', 'PageController@getPages');
Route::get('/page/{page}', 'PageController@getPageDetails');
Route::get('/blog/{blog}', 'BlogController@getBlogDetails');
Route::get('/news', 'NewsController@getNews');
Route::get('/news/{newsSlug}', 'NewsController@getNewsDetails');

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::post('/reset/password', 'AuthController@resetPassword');
Route::post('/confirm/password', 'AuthController@confirmPassword');
