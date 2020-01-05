<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Dashboard routes for your application.
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', 'AdminController@index');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
