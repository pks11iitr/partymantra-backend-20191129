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



    $api->post('login', ['as'=>'api.login', 'uses'=>'Auth\Api\LoginController@login']);
    $api->post('verify-otp', ['as'=>'api.otp.verify', 'uses'=>'Auth\Api\LoginController@verifyOTP']);


    $api->group(['middleware' => ['auth:api','acl'], 'is'=>'customer'], function ($api) {
        $api->get('home', ['as'=>'api.home', 'uses'=>'Auth\Api\LoginController@home']);
        $api->post('update-address', ['as'=>'api.updateaddress', 'uses'=>'Customer\ProfileController@updateAddress']);
    });



//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

