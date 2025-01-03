<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/warehouse/store', 'Manager\Warehouse\WarehouseController@store')->name('manager.warehouse.store');

Route::post('/webhook/ghn', 'WebhookController@handleWebhook')->name('webhook.ghn');

Route::post('/webhook/order', 'WebhookController@lookupOrderDetail')->name('webhook.order');

Route::get('/webhook/order', 'WebhookController@updateOrderStatus')->name('webhook.order.update');

Route::get('/webhook/order/all', 'Manager\Order\OrderController@getOrders')->name('webhook.order.update');




Route::get('/product','Customer\ProductController@getRecommendData');
Route::get('/product-2','Customer\ProductController@getRecommendData2');

Route::get('/product-ngrok-1','Customer\ProductController@getSimilarProduct_Ngrok');
Route::get('/product-ngrok-2','Customer\ProductController@getCollaborativeFiltering_Ngrok');