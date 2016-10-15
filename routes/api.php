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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
$api->resource('mahasiswa', 'App\Http\Controllers\Mahasiswa\MahasiswaController');
// $api->post('/tes', 'App\Http\Controllers\BikesController@store');
// $api->get('/tes/{id}/', 'App\Http\Controllers\api\BikesController@show');
// $api->patch('/tes/{id}/', 'App\Http\Controllers\api\BikesController@update');
//$api->destroy('/tes/{id}', 'App\Http\Controllers\api\BikesController@destroy');
});
