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
        $api->post('update-address', ['as'=>'api.updateaddress', 'uses'=>'Customer\Api\ProfileController@updateAddress']);
        //home page
        $api->get('home', ['as'=>'api.home', 'uses'=>'Customer\Api\HomeController@index']);
        //colections list
        $api->get('collections', ['as'=>'api.collections', 'uses'=>'Customer\Api\CollectionController@index']);
        //collection events
        $api->get('collection/{id}/events', ['as'=>'api.collection.events', 'uses'=>'Customer\Api\CollectionController@events']);
        //event details
        $api->get('event/{id}', ['as'=>'api.event.view', 'uses'=>'Customer\Api\EventController@view']);

    });





//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

