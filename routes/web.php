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
Route::get('social/{provider}', 'Auth\SocialiteController@redirectToProvider')->name('auth.socialite');
Route::get('social/{provider}/callback', 'Auth\SocialiteController@handleProviderCallback');

Route::get('/', 'HomeController@index')->name('home');
Route::get('about', 'PageController@about')->name('pages.about');
Route::get('privacy', 'PageController@privacy')->name('pages.privacy');
Route::get('terms', 'PageController@terms')->name('pages.terms');
Route::get('press', 'PageController@press')->name('pages.press');

Route::get('l/{uid}', 'LinkController@show')->name('links.show');

Route::middleware('auth')->group(function () {
    Route::view('subscribe', 'subscribe');

    Route::get('account', 'UserController@edit')->name('users.edit');
    Route::patch('account', 'UserController@update');
    Route::patch('account/password', 'UserController@changePassword');

    Route::post('referral/invites', 'ReferralController@invites')->name('referral.invites');
});

Route::get('sitemap.xml', 'SitemapController@sitemap')->name('sitemap');

Route::get('{profile}', 'ProfileController@show')->name('profiles.show');