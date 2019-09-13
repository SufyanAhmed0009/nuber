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
//Create new booking
Route::post('create','RequestController@store');

//show list of all booking
Route::get('list','RequestController@get');

Route::get('show/{code}','RequestController@showid');
//Route::apiresource('create','RequestController');
Route::delete('del/{id}','RequestController@delete');

Route::put('update/{id}','RequestController@update');

Route::get('pluck','RequestController@show');

Route::get('status','RequestController@status');

Route::put('cancel/{code}','RequestController@cancel');