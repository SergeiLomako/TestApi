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

Route::group(['prefix' => 'v1'], function () {
    Route::post('/register', ['uses' => 'Api\UserController@register']);
    Route::put('/send-code', ['uses' => 'Api\UserController@sendCode']);
    Route::put('/auth', ['uses' => 'Api\UserController@auth']);
    Route::post('/add-order', ['uses' => 'Api\OrderController@addOrder']);
    Route::get('/get-orders/{id?}', ['uses' => 'Api\OrderController@getList']);
});