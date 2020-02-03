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

        //profile apis
        $api->post('update-address', ['as'=>'api.updateaddress', 'uses'=>'Customer\Api\ProfileController@updateAddress']);
        $api->post('update-profile', ['as'=>'api.updateprofile', 'uses'=>'Customer\Api\ProfileController@updateProfile']);
        $api->get('profile', ['as'=>'api.profile', 'uses'=>'Customer\Api\ProfileController@getProfileInfo']);

        //cart apis starts
        //booking event
        $api->post('book', ['as'=>'api.order.book', 'uses'=>'Customer\Api\OrderController@addtocart']);
        //booking party
        //$api->post('book-party', ['as'=>'api.event.view', 'uses'=>'Customer\Api\OrderController@bookevent']);
        //booking-table
        //$api->post('book-table', ['as'=>'api.event.view', 'uses'=>'Customer\Api\OrderController@bookevent']);
        $api->get('cart-details', ['as'=>'api.order.cartdetails', 'uses'=>'Customer\Api\OrderController@cartdetails']);
        //cart api ends

        //payment apis starts
        $api->post('pay-now/{id?}', ['as'=>'api.order.pay', 'uses'=>'Customer\Api\OrderController@makeOrder']);
        $api->post('verify-payment', ['as'=>'api.payment.verify', 'uses'=>'Customer\Api\OrderController@verifyPayment']);
        //payment apis ends

        //add wallet money
        $api->post('add-money', ['as'=>'api.wallet.add', 'uses'=>'Customer\Api\WalletController@addMoney']);
        $api->post('verify-recharge', ['as'=>'api.wallet.add', 'uses'=>'Customer\Api\WalletController@verifyRecharge']);
        $api->get('wallet-history', ['as'=>'api.wallet.history', 'uses'=>'Customer\Api\WalletController@history']);
        $api->get('wallet-balance', ['as'=>'api.wallet.balance', 'uses'=>'Customer\Api\WalletController@getWalletBalance']);


        //order apis starts
        $api->get('order-history', ['as'=>'api.order.history', 'uses'=>'Customer\Api\OrderController@history']);
        $api->get('order-details/{id}', ['as'=>'api.order.details', 'uses'=>'Customer\Api\OrderController@details']);
        $api->get('cancel-order/{id}', ['as'=>'api.order.cancel', 'uses'=>'Customer\Api\OrderController@cancel']);
        //order apis ends

        //feedback apis starts
        $api->post('submit-review/{id}', ['as'=>'api.order.review', 'uses'=>'Customer\Api\OrderController@review']);
        //feedback apis ends
    });

    $api->get('get-qr/{id}', ['as'=>'api.order.qr', 'uses'=>'Customer\Api\OrderController@getQRcode']);
    /*
    authenticated routes ends
    */

    //home page
    $api->get('home', ['as'=>'api.home', 'uses'=>'Customer\Api\HomeController@index']);
    $api->get('search', ['as'=>'api.earch', 'uses'=>'Customer\Api\HomeController@search']);
    //colections list
    $api->get('collections', ['as'=>'api.collections', 'uses'=>'Customer\Api\CollectionController@index']);
    //collection events
    $api->get('collection/{id}/events', ['as'=>'api.collection.events', 'uses'=>'Customer\Api\CollectionController@events']);
    $api->get('collection/{id}/restaurants', ['as'=>'api.collection.events', 'uses'=>'Customer\Api\CollectionController@restaurants']);
    $api->get('collection/{id}/party', ['as'=>'api.collection.events', 'uses'=>'Customer\Api\CollectionController@party']);
    //event details
    $api->get('event/{id}', ['as'=>'api.event.view', 'uses'=>'Customer\Api\EventController@view']);
    $api->get('event/{id}/gallery', ['as'=>'api.event.gallery', 'uses'=>'Customer\Api\EventController@gallery']);
    $api->get('event/{id}/reviews', ['as'=>'api.event.reviews', 'uses'=>'Customer\Api\EventController@reviews']);
    //restaurant details
    $api->get('restaurant/{id}', ['as'=>'api.restaurant.view', 'uses'=>'Customer\Api\RestaurantController@view']);
    $api->get('party/{id}', ['as'=>'api.restaurant.view', 'uses'=>'Customer\Api\RestaurantController@partyview']);
    $api->get('restaurant/{id}/gallery', ['as'=>'api.restaurant.gallery', 'uses'=>'Customer\Api\RestaurantController@gallery']);
    $api->get('restaurant/{id}/reviews', ['as'=>'api.restaurant.reviews', 'uses'=>'Customer\Api\RestaurantController@reviews']);
$api->get('party/{id}/gallery', ['as'=>'api.party.gallery', 'uses'=>'Customer\Api\RestaurantController@partygallery']);
$api->get('party/{id}/reviews', ['as'=>'api.party.reviews', 'uses'=>'Customer\Api\RestaurantController@partyreviews']);

    /*
     * customer api routes ends
     */

    /*
     * Partner Api Routes Starts
     */

    $api->group(['middleware' => ['auth:api','acl'], 'is'=>'partner'], function ($api) {
        $api->get('mark-entry/{id}', ['as'=>'api.mark.entry', 'uses'=>'Partner\Api\OrderController@mark']);
        $api->get('partner-profile', ['as'=>'api.mark.entry', 'uses'=>'Partner\Api\ProfileController@profile']);
        $api->get('partner-order-details/{id}', ['as'=>'api.mark.entry', 'uses'=>'Partner\Api\OrderController@details']);
        $api->get('my-orders', ['as'=>'api.orders', 'uses'=>'Partner\Api\OrderController@index']);
    });

    /*
     * Partner API route ends
     */
