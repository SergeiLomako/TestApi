<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::post('/register', ['uses' => 'Api\UserController@register']);
    Route::put('/send_code', ['uses' => 'Api\UserController@send_code']);
    Route::put('/auth', ['uses' => 'Api\UserController@auth']);
    Route::post('/add_order', ['uses' => 'Api\OrderController@add_order']);
    Route::get('/get_orders/{id?}', ['uses' => 'Api\OrderController@get_list']);
});