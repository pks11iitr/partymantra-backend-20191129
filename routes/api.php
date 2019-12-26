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

    /*
    Customer application api routes
    /*
    authenticated routes starts
    */

    $api->group(['middleware' => ['auth:api','acl'], 'is'=>'customer'], function ($api) {
        $api->post('update-address', ['as'=>'api.updateaddress', 'uses'=>'Customer\Api\ProfileController@updateAddress']);
        $api->post('update-profile', ['as'=>'api.updateprofile', 'uses'=>'Customer\Api\ProfileController@updateProfile']);
        $api->get('profile', ['as'=>'api.profile', 'uses'=>'Customer\Api\ProfileController@getProfileInfo']);
        $api->post('book', ['as'=>'api.order.book', 'uses'=>'Customer\Api\OrderController@addtocart']);
        $api->post('pay-now/{id?}', ['as'=>'api.order.pay', 'uses'=>'Customer\Api\OrderController@makeOrder']);
        //$api->post('book-table', ['as'=>'api.event.view', 'uses'=>'Customer\Api\OrderController@bookevent']);
        //$api->post('book-party', ['as'=>'api.event.view', 'uses'=>'Customer\Api\OrderController@bookevent']);
        $api->get('order-history', ['as'=>'api.order.history', 'uses'=>'Customer\Api\OrderController@history']);
        $api->get('order-details/{id}', ['as'=>'api.order.details', 'uses'=>'Customer\Api\OrderController@details']);

        $api->post('submit-review/{id}', ['as'=>'api.order.review', 'uses'=>'Customer\Api\OrderController@review']);
        $api->get('cart-details', ['as'=>'api.order.cartdetails', 'uses'=>'Customer\Api\OrderController@cartdetails']);
    });

    $api->get('get-qr/{id}', ['as'=>'api.order.qr', 'uses'=>'Customer\Api\OrderController@getQRcode']);
    /*
    authenticated routes ends
    */

    //home page
    $api->get('home', ['as'=>'api.home', 'uses'=>'Customer\Api\HomeController@index']);
    //colections list
    $api->get('collections', ['as'=>'api.collections', 'uses'=>'Customer\Api\CollectionController@index']);
    //collection events
    $api->get('collection/{id}/events', ['as'=>'api.collection.events', 'uses'=>'Customer\Api\CollectionController@events']);
    //event details
    $api->get('event/{id}', ['as'=>'api.event.view', 'uses'=>'Customer\Api\EventController@view']);
    $api->get('event/{id}/gallery', ['as'=>'api.event.gallery', 'uses'=>'Customer\Api\EventController@gallery']);
    $api->get('event/{id}/reviews', ['as'=>'api.event.reviews', 'uses'=>'Customer\Api\EventController@reviews']);

    /*
     * customer api routes ends
     */

    $api->group(['middleware' => ['auth:api','acl'], 'is'=>'partner'], function ($api) {
        $api->get('mark-entry', ['as'=>'api.mark.entry', 'uses'=>'Customer\Api\OrderController@mark']);
    });
