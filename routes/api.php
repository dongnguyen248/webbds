<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function ($router) {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
});


    Route::resource('category', 'App\Http\Controllers\CategoryController');
    Route::resource('type', 'App\Http\Controllers\TypeController');
    Route::resource('article', 'App\Http\Controllers\ArticelController');
    // Route::post('article/{id}','App\Http\Controllers\ArticelController@update');
    Route::post('sendmail','App\Http\Controllers\MailCustomerSendController@send');

    // Route::get('category', 'App\Http\Controllers\CategoryController@index');
