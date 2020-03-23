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

Route::post('/users/filter' , 'usersController@filter');

// Api routes
Route::get('/migrar' , 'apiController@migrar');
//
Route::get('/users/all' , 'apiController@getAllUsers');
Route::get('/likes/all' , 'apiController@getAllLikes');
Route::get('/comments/all' , 'apiController@getAllComments');
Route::get('/videos/all' , 'apiController@getAllVideos');
Route::get('/restrictions/all' , 'apiController@getAllRestrictions');

Route::get('/theme/all' , 'apiController@getTheme');
Route::get('/packages/all' , 'apiController@getPackages');
Route::get('/gains/all' , 'apiController@getGains');
Route::get('/restrictions/all' , 'apiController@getAllRestrictions');

Route::post('/users/magnetism/add' , 'apiController@saveMagnetism');
Route::post('/users/magnetism/reset' , 'apiController@resetMagnetism');
Route::post('/users/add/magnetism/{id}' , 'apiController@addMagnetism');
Route::post('/users/add' , 'apiController@addShowUser');
Route::post('/users/saveInformation' , 'apiController@saveInformation');
