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
Route::get('social/{provider}', 'Auth\SocialiteController@redirectToProvider')->name('auth.social');
Route::get('social/{provider}/callback', 'Auth\SocialiteController@handleProviderCallback');

Route::get('/', 'HomeController@index')->name('home');

Route::get('about', 'HomeController@index')->name('pages.about');
Route::get('privacy', 'HomeController@index')->name('pages.privacy');
Route::get('terms', 'HomeController@index')->name('pages.terms');

Route::middleware('auth')->group(function () {
    Route::get('account', 'UserController@edit')->name('users.edit');
    Route::patch('account', 'UserController@update');
    Route::patch('account/password', 'UserController@changePassword');

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
});

Route::get('{profile}', 'ProfileController@show')->name('profiles.show');