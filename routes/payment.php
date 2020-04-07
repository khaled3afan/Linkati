<?php

/**
 * This Routes laravel-cashier-paddle
 */

use Illuminate\Support\Facades\Route;

Route::get('payment/{id}', 'PaymentController@show')->name('payment');
Route::post('webhook/paddle', 'WebhookController@handleWebhook')->name('webhook.paddle');
