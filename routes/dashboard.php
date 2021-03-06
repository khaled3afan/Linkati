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

Route::group(['middleware' => 'verified'], function () {
    Route::get('profile/create', 'ProfileController@create')->name('profiles.create');
});

// api
Route::group(['prefix' => 'api/{profile}'], function () {
    Route::get('/edit', 'ProfileController@edit');
    Route::put('/update', 'ProfileController@update');
    Route::post('/create', 'ProfileController@store');

    Route::put('theme/update', 'ProfileController@update');

    Route::put('/links/create', 'LinkController@store');
    Route::delete('/links/{link}', 'LinkController@destroy');
    Route::put('/links/{link}', 'LinkController@update');
    Route::put('/links/{link}/resort', 'LinkController@resort');
});

Route::get('{profile}', 'ProfileController@show')->name('profiles.show');
