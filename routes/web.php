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

Route::get('/', 'Guest\HomeController@index');
Route::get('home', 'Guest\HomeController@index');


Route::get('user', function () {
    return redirect()->route('user.dashboard');
});

Route::group(['prefix' => 'user'], function () {


    Route::group(['middleware' => 'guest:user'], function () {

        // Authentication Routes...
        Route::get('login', 'User\Auth\LoginController@showLoginForm')->name('user.login');
        Route::post('login', 'User\Auth\LoginController@login');

        // Registration Routes...
        Route::get('register', 'User\Auth\RegisterController@showRegistrationForm')->name('user.register');
        Route::post('register', 'User\Auth\RegisterController@register');

        // Password Reset Routes...
        Route::get('password/reset', 'User\Auth\ForgotPasswordController@showLinkRequestForm')->name('user.password.request');
        Route::post('password/email', 'User\Auth\ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
        Route::get('password/reset/{token}', 'User\Auth\ResetPasswordController@showResetForm')->name('user.password.reset');
        Route::post('password/reset', 'User\Auth\ResetPasswordController@reset');
    });

    Route::group(['middleware' => 'auth:user'], function () {

        // Authentication Routes...
        Route::post('logout', 'User\Auth\LoginController@logout')->name('user.logout');

        Route::get('dashboard', 'User\DashboardController@index')->name('user.dashboard');
    });

});


Route::get('admin', function () {
    return redirect()->route('admin.dashboard');
});

Route::group(['prefix' => 'admin'], function () {


    Route::group(['middleware' => 'guest:admin'], function () {

        // Authentication Routes...
        Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
        Route::post('login', 'Admin\Auth\LoginController@login');

        // Registration Routes...
        Route::get('register', 'Admin\Auth\RegisterController@showRegistrationForm')->name('admin.register');
        Route::post('register', 'Admin\Auth\RegisterController@register');

        // Password Reset Routes...
        Route::get('password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
        Route::post('password/reset', 'Admin\Auth\ResetPasswordController@reset');
    });

    Route::group(['middleware' => 'auth:admin'], function () {

        // Authentication Routes...
        Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

        Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    });

});