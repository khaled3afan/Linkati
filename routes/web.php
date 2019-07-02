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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('{profile}', 'ProfileController@index')->name('profiles.edit');


Route::middleware('auth')->group(function () {
    // view
    Route::get('{profile}', 'ProfileController@show')->name('profiles.show');
    Route::get('{profile}/edit', 'ProfileController@edit')->name('profiles.edit');

    // api
    Route::group(['prefix' => 'api/profile'], function () {
        Route::put('/update', 'ProfileController@update');
    });
});