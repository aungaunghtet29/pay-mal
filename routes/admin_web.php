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





Route::prefix('admin')->middleware('auth:admin_user')->name('admin.')->namespace('App\Http\Controllers\Backend')->group(function () {
    Route::get('/' , 'PageController@home')->name('home');


    Route::resource('admin-user', 'AdminUserController');
    Route::get('admin-user/datatables/server' , 'AdminUserController@server');

    Route::resource('user', 'UserController');
    Route::get('user/datatables/server' , 'UserController@server');


    Route::get('wallet' , 'WalletController@index')->name('wallet.index');
    Route::get('wallet/datatables/server' , 'WalletController@server');

});

