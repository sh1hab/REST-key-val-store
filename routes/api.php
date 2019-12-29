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

    // Route::get('/values/{keys?}','KeysController@set_ttl')->name('getValues');

    Route::get('/values/{keys?}','KeysController@getValues')->name('getValues');
    Route::post('/values','KeysController@saveValues')->name('saveValues');
    Route::patch('/values','KeysController@updateValues')->name('updateValues');
    // Route::post('/keys','KeysController@saveKeys')->name('saveKeys');

});
