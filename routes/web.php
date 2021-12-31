<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('cart', [App\Http\Controllers\HomeController::class, 'cart'])->name('cart');
Route::post('cart-update', [App\Http\Controllers\HomeController::class, 'cartUpdate'])->name('cart-update');
Route::get('checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout');
Route::post('order-checkout',[App\Http\Controllers\OrderController::class, 'store'])->name('order-checkout');
Route::get('order-complete/{id}',[App\Http\Controllers\OrderController::class, 'complete'])->name('order-complete');


Route::post('products/addToCart', [App\Http\Controllers\ProductController::class, 'addToCart']);
Route::get('products/cartItems',[App\Http\Controllers\ProductController::class, 'cartItems']);
Route::get('products/loadSidbarCart',[App\Http\Controllers\ProductController::class, 'loadSidbarCart']);
Route::post('products/removeCartItem',[App\Http\Controllers\ProductController::class, 'removeCartItem']);
Route::get('paymentGateway',[App\Http\Controllers\HomeController::class, 'paymentGateway']);
Route::get('cartTotals',[App\Http\Controllers\HomeController::class, 'cartTotals']);

Route::post('apply-coupon',[App\Http\Controllers\HomeController::class, 'apply_coupon'])->name('apply-coupon');
Route::get('remove-coupon',[App\Http\Controllers\HomeController::class, 'remove_coupon'])->name('remove-coupon');

Route::get('remove-contribution',[App\Http\Controllers\HomeController::class, 'remove_contribution'])->name('remove-contribution');

Route::get('products', [App\Http\Controllers\HomeController::class, 'products'])->name('products');
Route::get('about-us',[App\Http\Controllers\HomeController::class, 'about'])->name('about-us');
Route::get('social-responsibility',[App\Http\Controllers\HomeController::class, 'socialResponsibility'])->name('social-responsibility');
Route::get('special-offers',[App\Http\Controllers\HomeController::class, 'specialOffers'])->name('special-offers');
Route::get('volunteer-with-us',[App\Http\Controllers\HomeController::class, 'volunteerWithus'])->name('volunteer-with-us');
Route::post('volunteer-form',[App\Http\Controllers\HomeController::class, 'volunteerForm'])->name('volunteer-form');  
Route::get('contact-us',[App\Http\Controllers\HomeController::class, 'contact'])->name('contact-us');
Route::post('contactForm',[App\Http\Controllers\HomeController::class, 'contactForm'])->name('contactForm');
Route::get('faq',[App\Http\Controllers\HomeController::class, 'faq'])->name('faq');
Route::get('privacy-policy',[App\Http\Controllers\HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('terms-and-conditions',[App\Http\Controllers\HomeController::class, 'termsConditions'])->name('terms-and-conditions');

Route::post('subscribe',[App\Http\Controllers\HomeController::class, 'subscribeForm'])->name('subscribe');  


//Facebook Login
Route::get('login/facebook',[App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('user.facebook.redirect');
Route::get('login/facebook/callback',[App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback'])->name('user.facebook.callback');
//Facebook Login

//Google Login
Route::get('login/google',[App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('user.google.redirect');
Route::get('login/google/callback',[App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback'])->name('user.google.callback');
//Google Login

Route::get('/convert-to-json', function () {
    return App\Employee::paginate(5);
});


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    echo 'Cache Cleared';
    // return what you want
});

//Invite Link
Route::get('invite/{code}', [App\Http\Controllers\UserController::class, 'validateReferralLink']);
//Invite Link
Route::post('calculateDeliveryCharge',[App\Http\Controllers\HomeController::class, 'calculateDeliveryCharge'])->name('calculateDeliveryCharge');


Route::middleware('auth')->group(function () {

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index'); 
    Route::post('uploads/store', 'UploadController@store')->name('medias.create');
    Route::get('my-account/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('users.profile');
    Route::get('my-account/change-password', 'UserController@changePassword')->name('change-password');
    Route::get('my-account/rewards', [App\Http\Controllers\UserController::class, 'rewards'])->name('rewards');
    Route::get('my-account/delivery-address', [App\Http\Controllers\UserController::class, 'deliveryAddress'])->name('users.delivery-address');
    Route::get('my-account/orders', [App\Http\Controllers\UserController::class, 'orders'])->name('users.orders');
    Route::get('my-account/order/{order_id}', [App\Http\Controllers\UserController::class, 'orderDetail'])->name('users.order');
    Route::get('my-account/order-tracking', [App\Http\Controllers\UserController::class, 'orderTracking'])->name('users.orderTracking');
    Route::get('my-account/order-track', [App\Http\Controllers\UserController::class, 'orderTrack'])->name('users.orderTrack');
    Route::post('users/remove-media', [App\Http\Controllers\UserController::class, 'removeMedia']);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('wishlist', [App\Http\Controllers\HomeController::class, 'wishlist'])->name('wishlist');
    Route::get('products/addToFavorite',[App\Http\Controllers\ProductController::class, 'addToFavorite']);
    Route::post('products/addreview', [App\Http\Controllers\ProductController::class, 'storeReview'])->name('products.addreview');


    Route::post('deliveryAddresses/store', [App\Http\Controllers\DeliveryAddressController::class, 'store'])->name('deliveryAddresses');
    Route::delete('deliveryAddresses/destroy{id}',[App\Http\Controllers\DeliveryAddressController::class, 'destroy'])->name('deliveryAddresses.destroy');
    Route::get('deliveryAddresses/{id}', [App\Http\Controllers\DeliveryAddressController::class, 'show']);
    Route::patch('deliveryAddresses/{id}', [App\Http\Controllers\DeliveryAddressController::class, 'update']);

    Route::post('redeemPoints',[App\Http\Controllers\HomeController::class, 'redeemPoints'])->name('redeemPoints');
    Route::get('remove-redeem',[App\Http\Controllers\HomeController::class, 'remove_redeem'])->name('remove-redeem');
    //Route::resource('deliveryAddresses', 'DeliveryAddressController')->name('deliveryAddresses');

});

Route::group(['prefix' => 'category'], function () {
    Route::get('/{category_id}/{category_slug?}', [App\Http\Controllers\HomeController::class, 'showCategoryProduct'])->name('showCategoryProduct');
});

Route::group(['prefix' => 'product'], function () {
    Route::get('/{product_id}/{product_slug?}', [App\Http\Controllers\HomeController::class, 'showProduct'])->name('showProduct');
});
