<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth::routes();
Route::get('login', 'Auth\Website\LoginController@showLoginForm')->name('login.form');
Route::post('login', 'Auth\Website\LoginController@login')->name('login');
Route::get('verify-otp', 'Auth\Website\LoginController@OTPForm')->name('otp.verify');
Route::post('verify', 'Auth\Website\LoginController@verifyOTP')->name('verify');
Route::post('logout', 'Auth\Website\LoginController@logout')->name('logout');


//website routes
Route::get('/', 'Website\HomeController@index')->name('website.home');
Route::get('collections', 'Website\CollectionController@index')->name('website.collections');
Route::get('collections/{id}/event', 'Website\CollectionController@events')->name('website.collection.event');
Route::get('collections/{id}/restaurant', 'Website\CollectionController@restaurants')->name('website.collection.restaurant');
Route::get('collections/{id}/party', 'Website\CollectionController@party')->name('website.collection.party');
Route::get('event/{id}', 'Website\EventController@view')->name('website.event.details');
Route::get('restaurant/{id}', 'Website\RestaurantController@view')->name('website.restaurant.details');
Route::get('party/{id}', 'Website\RestaurantController@partyView')->name('website.party.details');

Route::post('book', 'Website\OrderController@addToCart')->name('website.book');
Route::get('cart-details', 'Website\OrderController@cartdetails')->name('website.cart.details');
Route::get('order-details/{id}', 'Website\OrderController@details')->name('website.order.details');
Route::get('pay-now', 'Website\OrderController@makeOrder')->name('website.pay');
Route::post('verify-payment', 'Website\OrderController@verifyPayment')->name('website.verify.payment');




Route::get('privacy-policy', 'Website\TncController@privacy');
Route::get('terms-and-condition', 'Website\TncController@tnc');
Route::get('about-us', 'Website\TncController@about');

/*
 * Website Routes Ends
 */


/*
 * Admin Partner Routes Starts
 */

//Admin Partner Login routes
Route::group(['prefix'=>'admin'], function() {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login.form');
    Route::post('login', 'Auth\LoginController@login')->name('admin.login');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.reset');
    Route::post('password/otp', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.send.otp');
    Route::get('password/reset-form', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('admin.password.update');
    Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');
});

/*
 * Admin Panel Routes
 */

Route::group(['middleware'=>['auth', 'acl'], 'prefix'=>'admin', 'is'=>'admin'], function(){
        Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
        Route::get('orders', 'Admin\OrderController@index')->name('admin.orders');
        Route::get('order-details/{id}', 'Admin\OrderController@details')->name('admin.orders.details');
        Route::get('approve-cancel/{id}', 'Admin\OrderController@cancelapprove')->name('admin.orders.cancelapprove');
        Route::get('partners', 'Admin\PartnerController@index')->name('admin.partners');
        Route::get('partners/create', 'Admin\PartnerController@add')->name('admin.partners.add');
        Route::post('partners', 'Admin\PartnerController@store')->name('admin.partners.store');
        Route::get('partners/{id}', 'Admin\PartnerController@edit')->where('id', '[0-9]+')->name('admin.partners.edit');
        Route::post('partners/{id}', 'Admin\PartnerController@update')->where('id', '[0-9]+')->name('admin.partners.update');
        Route::post('partner/{id}/change-password', 'Admin\PartnerController@changepartnerpassword')->name('admin.partner.changepass');
        Route::post('attach-menu/{id}', 'Admin\PartnerController@attachMenu')->name('admin.partner.addmenu');
        Route::get('detach-menu/{pid}/{mid}', 'Admin\PartnerController@detachMenu')->name('admin.partner.delmenu');
        Route::post('attach-facility/{id}', 'Admin\PartnerController@attachFacility')->name('admin.partner.addfacility');
        Route::get('detach-facility/{pid}/{fid}', 'Admin\PartnerController@detachFacility')->name('admin.partner.delfacility');
        Route::post('partner/{id}/add-gallery', 'Admin\PartnerController@addgallery')->name('admin.partner.gallery');
        Route::get('partner/del-gallery/{id}', 'Admin\PartnerController@deletegallery')->name('admin.partner.galleryrm');
    Route::post('partner/{id}/add-event-party', 'Admin\PartnerController@addEventPartyImage')->name('admin.partner.partyevent');

        Route::get('users', 'Admin\UserController@index')->name('admin.users');

        Route::get('category', 'Admin\CategoryController@index')->name('admin.category');
        Route::get('category/create', 'Admin\CategoryController@add')->name('admin.category.add');
        Route::post('category', 'Admin\CategoryController@store')->name('admin.category.store');
        Route::get('category/{id}', 'Admin\CategoryController@edit')->where('id', '[0-9]+')->name('admin.category.edit');
        Route::post('category/{id}', 'Admin\CategoryController@update')->where('id', '[0-9]+')->name('admin.category.update');


        Route::get('cusines', 'Admin\CusineController@index')->name('admin.cusines');
        Route::get('cusines/create', 'Admin\CusineController@add')->name('admin.cusines.add');
        Route::post('cusines', 'Admin\CusineController@store')->name('admin.cusines.store');
        Route::get('cusines/{id}', 'Admin\CusineController@edit')->where('id', '[0-9]+')->name('admin.cusines.edit');
        Route::post('cusines/{id}', 'Admin\CusineController@update')->where('id', '[0-9]+')->name('admin.cusines.update');



        Route::get('event', 'Admin\EventController@index')->name('admin.event');
        Route::get('event/create', 'Admin\EventController@add')->name('admin.event.add');
        Route::post('event', 'Admin\EventController@store')->name('admin.event.store');
        Route::post('events/{id}/add-gallery', 'Admin\EventController@addgallery')->name('admin.event.gallery');
        Route::get('events/del-gallery/{id}', 'Admin\EventController@deletegallery')->name('admin.event.galleryrm');
        Route::get('event/{id}', 'Admin\EventController@edit')->where('id', '[0-9]+')->name('admin.event.edit');
        Route::post('event/{id}', 'Admin\EventController@update')->where('id', '[0-9]+')->name('admin.event.update');


        Route::get('collection', 'Admin\CollectionController@index')->name('admin.collection');
        Route::get('collection/create', 'Admin\CollectionController@add')->name('admin.collection.add');
        Route::post('collection', 'Admin\CollectionController@store')->name('admin.collection.store');
        Route::get('collection/{id}', 'Admin\CollectionController@edit')->where('id', '[0-9]+')->name('admin.collection.edit');
        Route::post('collection/{id}', 'Admin\CollectionController@update')->where('id', '[0-9]+')->name('admin.collection.update');

        Route::get('menu', 'Admin\MenuController@index')->name('admin.menu');
        Route::get('menu/create', 'Admin\MenuController@add')->name('admin.menu.add');
        Route::post('menu', 'Admin\MenuController@store')->name('admin.menu.store');
        Route::get('menu/{id}', 'Admin\MenuController@edit')->where('id', '[0-9]+')->name('admin.menu.edit');
        Route::post('menu/{id}', 'Admin\MenuController@update')->where('id', '[0-9]+')->name('admin.menu.update');
        Route::get('partner-menu/{id}', 'Admin\MenuController@partnermenus')->name('partner.menus');
        Route::get('partner-package/{id}', 'Admin\MenuController@partnermenus')->name('partner.package');


        Route::get('package', 'Admin\EventPackagesController@index')->name('admin.package');
        Route::get('package/create', 'Admin\EventPackagesController@add')->name('admin.package.add');
        Route::post('package', 'Admin\EventPackagesController@store')->name('admin.package.store');
        Route::get('package/{id}', 'Admin\EventPackagesController@edit')->where('id', '[0-9]+')->name('admin.package.edit');
        Route::post('package/{id}', 'Admin\EventPackagesController@update')->where('id', '[0-9]+')->name('admin.package.update');


        Route::get('ajexdata','Admin\BannerController@ajexdataa')->name('banner.ajax');
        Route::get('banner', 'Admin\BannerController@index')->name('admin.banner');
        Route::get('banner/create', 'Admin\BannerController@add')->name('admin.banner.add');
        Route::post('banner', 'Admin\BannerController@store')->name('admin.banner.store');
        Route::get('banner/{id}', 'Admin\BannerController@edit')->where('id', '[0-9]+')->name('admin.banner.edit');
        Route::post('banner/{id}', 'Admin\BannerController@update')->where('id', '[0-9]+')->name('admin.banner.update');
        Route::get('select-menu-for-package/{id}', 'Admin\EventPackagesController@ajaxselectmenuevent')->name('partner.packagemenu.ajax');
    Route::get('payment-history', 'Admin\OrderController@paymenthistory')->name('payment.history');

    Route::get('notification-form', 'Admin\NotificationController@create')->name('admin.notification.create');
    Route::post('send', 'Admin\NotificationController@send')->name('admin.notification.send');

});

/*
 * Partner Panel Routes
 */

Route::group(['middleware'=>['auth', 'acl'], 'prefix'=>'partner', 'is'=>'partner'], function(){
        Route::get('dashboard', 'Partner\DashboardController@index')->name('partner.dashboard');
    Route::get('orders', 'Partner\OrderController@index')->name('partner.orders');

        Route::get('menu', 'Partner\MenuController@index')->name('partner.menu');
        Route::get('menu/create', 'Partner\MenuController@add')->name('partner.menu.add');
        Route::post('menu', 'Partner\MenuController@store')->name('partner.menu.store');
        Route::get('menu/{id}', 'Partner\MenuController@edit')->where('id', '[0-9]+')->name('partner.menu.edit');
        Route::post('menu/{id}', 'Partner\MenuController@update')->where('id', '[0-9]+')->name('partner.menu.update');



        Route::get('event', 'Partner\EventController@index')->name('partner.event');
        Route::get('event/create', 'Partner\EventController@add')->name('partner.event.add');
        Route::post('event', 'Partner\EventController@store')->name('partner.event.store');
        Route::get('event/{id}', 'Partner\EventController@edit')->where('id', '[0-9]+')->name('partner.event.edit');
        Route::post('event/{id}', 'Partner\EventController@update')->where('id', '[0-9]+')->name('partner.event.update');
    Route::post('events/{id}/add-gallery', 'Partner\EventController@addgallery')->name('partner.event.gallery');
    Route::get('events/del-gallery/{id}', 'Partner\EventController@deletegallery')->name('partner.event.galleryrm');


        Route::get('package', 'Partner\EventPackagesController@index')->name('partner.package');
        Route::get('package/create', 'Partner\EventPackagesController@add')->name('partner.package.add');
        Route::post('package', 'Partner\EventPackagesController@store')->name('partner.package.store');
        Route::get('package/{id}', 'Partner\EventPackagesController@edit')->where('id', '[0-9]+')->name('partner.package.edit');
        Route::post('package/{id}', 'Partner\EventPackagesController@update')->where('id', '[0-9]+')->name('partner.package.update');



});

/*
 * Admin Partner Routes Ends
 */
