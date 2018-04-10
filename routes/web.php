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
Route::get('/login', ['as' => 'admin_login', function () {
    if (view()->exists('admin_login_form')) {
        return view('admin_login_form');
    }
}]);

Route::get('/remember', ['as' => 'remember', function () {
    if (view()->exists('admin_login_form')) {
        return view('admin_login_form', ['remember' => true]);
    }
}]);

Route::post('/send-token', ['uses' => 'Auth\ForgotPasswordController@sendMail','as' => 'send_token']);

Route::get('/change-password-form/{token}', ['uses' => 'Auth\ResetPasswordController@changePasswordForm','as' => 'change_password_form']);

Route::post('/save-password', ['uses' => 'Auth\ResetPasswordController@savePassword','as' => 'save_password']);

Route::post('/auth', ['uses' => 'Auth\LoginController@login','as' => 'admin_auth']);


Route::group(['prefix' => 'admin', 'middleware' => ['role:super_admin|admin|moderator']], function () {

    Route::get('/', ['as' => 'admin_main', function() {
        if (view()->exists('admin.main.main')) {
            return view('admin.main.main', ['title' => 'Панель администратора']);
        }
        abort(404);
    }]);

    Route::post('/logout', ['uses' => 'Auth\LoginController@logout','as' => 'admin_logout']);

    Route::group(['prefix' => 'users', 'middleware' => ['role:super_admin|admin']], function () {

        Route::get('/', ['uses' => 'Admin\UserController@index', 'as' => 'users']);

        Route::post('/', ['uses' => 'Admin\UserController@store', 'as' => 'store_user']);

        Route::get('/store', ['uses' => 'Admin\UserController@showStoreForm', 'as' => 'store_user_form','middleware' => ['role:super_admin']]);

        Route::get('/search', ['uses' => 'Admin\UserController@search', 'as' => 'search_user']);

        Route::put('/{id}', ['uses' => 'Admin\UserController@update', 'as' => 'update_user']);

        Route::delete('/{id}', ['uses' => 'Admin\UserController@delete', 'as' => 'delete_user']);

        Route::get('/{id}', ['uses' => 'Admin\UserController@show', 'as' => 'show_user']);


    });

    Route::group(['prefix' => 'orders'], function () {

        Route::get('/', ['uses' => 'Admin\OrderController@index', 'as' => 'orders']);

        Route::post('/', ['uses' => 'Admin\OrderController@store', 'as' => 'store_order']);

        Route::get('/store', ['uses' => 'Admin\OrderController@showStoreForm', 'as' => 'store_order_form', 'middleware' => ['role:super_admin']]);

        Route::get('/search', ['uses' => 'Admin\OrderController@search', 'as' => 'search_order']);

        Route::put('/{id}', ['uses' => 'Admin\OrderController@update', 'as' => 'update_order', 'middleware' => ['role:super_admin']]);

        Route::delete('/{id}', ['uses' => 'Admin\OrderController@delete', 'as' => 'delete_order', 'middleware' => ['role:super_admin']]);

        Route::get('/{id}', ['uses' => 'Admin\OrderController@show', 'as' => 'info_order']);


    });

});
