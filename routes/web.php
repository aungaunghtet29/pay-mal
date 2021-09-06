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


Auth::routes();
Route::get('admin/login', 'App\Http\Controllers\Auth\AdminLoginController@showLoginForm');
Route::post('admin/login', 'App\Http\Controllers\Auth\AdminLoginController@login')->name('admin.login');



Route::middleware('auth')->namespace('App\Http\Controllers\Frontend')->group( function () {
    Route::get('/', 'PageController@index')->name('home');

    Route::get('/wallet' ,'PageController@wallet')->name('wallet');
    Route::get('/transcation' ,'PageController@transcation')->name('transcation');
    Route::get('/transcation/{id}' ,'PageController@transcationDetail');
    Route::get('/account' ,'PageController@account')->name('account');
    //Route::get('language-setting' , 'PageController@language');
    //Route::get('language-setting/{language}' , 'PageController@languageStore');

    Route::get('/change-password' , 'PageController@changePassword')->name('change.password');
    Route::post('/change-password' , 'PageController@changePasswordStore')->name('change.password.store');


    Route::get('/transfer' , 'PageController@transfer')->name('transfer');
    Route::post('/transfer/draw-amount' , 'PageController@drawAmount')->name('draw.amount');
    Route::post('/transfer/confirm-password' , 'PageController@transferConfirmPassword')->name('transfer.confirm');

    Route::get('/password-check' ,'PageController@passwordCheck');
    Route::get('/phone-verify' , 'PageController@phoneVerify');
});
