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

Route::get('/', function () {
    //return view('welcome');
    return redirect(route('login'));
});

Auth::routes();

//this will be removed after setting proper redirection
//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>['auth', 'acl'], 'prefix'=>'admin', 'is'=>'admin'], function(){
    Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::get('partners', 'Admin\PartnerController@index')->name('admin.partners');
    Route::get('partners/create', 'Admin\PartnerController@add')->name('admin.partners.add');
    Route::post('partners', 'Admin\PartnerController@store')->name('admin.partners.store');
    Route::get('partners/{id}', 'Admin\PartnerController@edit')->where('id', '[0-9]+')->name('admin.partners.edit');
    Route::post('partners/{id}', 'Admin\PartnerController@update')->where('id', '[0-9]+')->name('admin.partners.update');


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
    Route::get('menu-partner/{id}', 'Admin\MenuController@partnermenus')->name('partner.menus');


	Route::get('ajexdata','Admin\BannerController@ajexdataa')->name('banner.ajax');
     Route::get('banner', 'Admin\BannerController@index')->name('admin.banner');
    Route::get('banner/create', 'Admin\BannerController@add')->name('admin.banner.add');
    Route::post('banner', 'Admin\BannerController@store')->name('admin.banner.store');
    Route::get('banner/{id}', 'Admin\BannerController@edit')->where('id', '[0-9]+')->name('admin.banner.edit');
    Route::post('banner/{id}', 'Admin\BannerController@update')->where('id', '[0-9]+')->name('admin.banner.update');
    Route::get('partner-packages/{id}', 'Admin\EventController@ajaxpartnerevent')->name('partner.package.ajax');

});

Route::group(['middleware'=>['auth', 'acl'], 'prefix'=>'partner', 'is'=>'partner'], function(){
Route::get('dashboard', 'Partner\DashboardController@index')->name('partner.dashboard');


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



});

