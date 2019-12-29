<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building breyour API!
|
*/

Route::get('/values/{keys?}','KeysController@getValues')->name('getValues');
Route::post('/values','KeysController@saveValues')->name('saveValues');
Route::patch('/values','KeysController@updateValues')->name('updateValues');

