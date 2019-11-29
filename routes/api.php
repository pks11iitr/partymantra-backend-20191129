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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    $api->group(['middleware' => 'auth:api'], function ($api) {
        $api->get('home', ['as'=>'api.home', 'uses'=>'App\Http\Controllers\Auth\Api\LoginController@home']);
    });

    $api->post('login', ['as'=>'api.login', 'uses'=>'App\Http\Controllers\Auth\Api\LoginController@login']);
    $api->post('verify-otp', ['as'=>'api.otp.verify', 'uses'=>'App\Http\Controllers\Auth\Api\LoginController@verifyOTP']);

});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

