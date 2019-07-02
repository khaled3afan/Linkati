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

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

Route::get('{profile}', 'ProfileController@show')->name('profiles.show');

Route::middleware('auth')->group(function () {
    // api
    Route::group(['prefix' => 'api/profile'], function () {
        Route::put('/update', 'ProfileController@update');
    });
});