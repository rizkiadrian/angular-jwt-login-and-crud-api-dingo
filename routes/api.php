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
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
$api->resource('images', 'App\Http\Controllers\imageController\imageController');
$api->resource('mahasiswa', 'App\Http\Controllers\Mahasiswa\MahasiswaController');
$api->resource('authenticate', 'App\Http\Controllers\Auth\AuthenticateController', ['only' => ['index']]);
$api->post('authenticate', 'App\Http\Controllers\Auth\AuthenticateController@authenticate');
$api->get('getid', 'App\Http\Controllers\Auth\AuthenticateController@getAuthenticatedUser');
$api->get('image/{filename}','App\Http\Controllers\imageController\imageController@getimage');
$api->get('imagor/{filename}','App\Http\Controllers\imageController\imageController@getoriimage');
});
	