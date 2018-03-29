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

Route::post('/send_token', ['uses' => 'Auth\ForgotPasswordController@sendMail','as' => 'send_token']);

Route::get('/change_password_form/{token}', ['uses' => 'Auth\ResetPasswordController@changePasswordForm','as' => 'change_password_form']);

Route::post('/save_password', ['uses' => 'Auth\ResetPasswordController@savePassword','as' => 'save_password']);

Route::post('/auth', ['uses' => 'Auth\LoginController@login','as' => 'admin_auth']);


Route::group(['prefix' => 'admin', 'middleware' => ['role:super_admin|admin|moderator']], function () {

    Route::get('/', ['as' => 'admin_main', function() {
        if (view()->exists('admin.main.main')) {
            return view('admin.main.main', ['title' => 'Панель администратора']);
        }
        abort(404);
    }]);

    Route::post('/logout', ['uses' => 'Auth\LoginController@logout','as' => 'admin_logout']);

    Route::group(['prefix' => 'user', 'middleware' => ['role:super_admin|admin']], function () {

        Route::get('/', ['uses' => 'Admin\UserController@index', 'as' => 'user']);

        Route::match(['get', 'post'],'/add', ['uses' => 'Admin\UserController@add', 'as' => 'add_user','middleware' => ['role:super_admin']]);

        Route::put('/update/{id}', ['uses' => 'Admin\UserController@update', 'as' => 'update_user']);

        Route::delete('/delete', ['uses' => 'Admin\UserController@delete', 'as' => 'delete_user']);

        Route::get('/info', ['uses' => 'Admin\UserController@getInfo', 'as' => 'info_user']);

        Route::get('/search', ['uses' => 'Admin\UserController@search', 'as' => 'search_user']);

    });

    Route::group(['prefix' => 'order'], function () {

        Route::get('/', ['uses' => 'Admin\OrderController@index', 'as' => 'order']);

        Route::match(['get', 'post'],'/add', ['uses' => 'Admin\OrderController@add', 'as' => 'add_order', 'middleware' => ['role:super_admin']]);

        Route::put('/update/{id}', ['uses' => 'Admin\OrderController@update', 'as' => 'update_order', 'middleware' => ['role:super_admin']]);

        Route::delete('/delete', ['uses' => 'Admin\OrderController@delete', 'as' => 'delete_order', 'middleware' => ['role:super_admin']]);

        Route::get('/info', ['uses' => 'Admin\OrderController@getInfo', 'as' => 'info_order']);

        Route::get('/search', ['uses' => 'Admin\OrderController@search', 'as' => 'search_order']);

    });

});
