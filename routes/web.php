<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/User/{id}/{Shubham}', function ($id,$name) {
//     return 'welcome'.$id.$name;
// });
Route::get('/','LandingPageController@index')->name('Landing-page');
Route::get('/Services','LandingPageController@view');
Route::get('/Products','ProductsPageController@index')->name('Products');
Route::get('/Products/{product}','ProductsPageController@show')->name('product.show');
Route::get('/Cart','CartController@index')->name('cart.index');
Route::post('/Cart','CartController@store')->name('cart.store');

Route::patch('/Cart/{product}','CartController@update')->name('cart.update');
Route::delete('/Cart/{product}','CartController@destroy')->name('cart.destroy');
Route::post('/Cart/SwitchToSaveForLater/{product}','CartController@SwitchToSaveForLater')->name('cart.SwitchToSaveForLater');


Route::delete('/saveForLater/{product}','SaveForLaterController@destroy')->name('saveForLater.destroy');
Route::post('/saveForLater/SwitchToCart/{product}','SaveForLaterController@switchToCart')->name('saveForLater.SwitchToCart');



// Coupons Code
Route::post('/coupon','CouponsController@store')->name('coupon.store');
Route::delete('/coupon','CouponsController@destroy')->name('coupon.destroy');



//Stripe Payment Gateway
Route::get('/checkout','CheckoutController@index')->name('checkout.index');
Route::post('/checkout','CheckoutController@store')->name('checkout.store');


//Payumoney Payment gateway
Route::get('/pay', ['as' => 'pay', 'uses' => 'PaymentController@pay']);
Route::get('/payment/status', ['as' => 'payment_status', 'uses' => 'PaymentController@status']);

Route::get('empty',function(){
		Cart::instance('saveForLater')->destroy();
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
