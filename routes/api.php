<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix'=>'v1'],function(){

    Route::get('/values/{keys?}','KeysController@getValues')->name('getValues');
    Route::post('/values','KeysController@saveKeys')->name('saveKeys');
    Route::patch('/values','KeysController@saveKeys')->name('updateKeys');
    // Route::post('/keys','KeysController@saveKeys')->name('saveKeys');

});
