<?php

use Illuminate\Support\Facades\Route;

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

//Route register
Route::get('register','AuthController@register')->name('auth.register');
Route::post('register','AuthController@registerSubmit')->name('auth.register-submit');
//Route logout
Route::get('logout','AuthController@logout')->name('auth.logout');

//Route login
Route::get('login','AuthController@login')->name('auth.login');
Route::post('login','AuthController@loginSubmit')->name('auth.login-submit');

//Route client
Route::get('/home','ClientController@index')->name('client.index');
Route::get('/home/categories/','ClientController@categoriesLayout')->name('home.categories');
Route::get('/home/checkout','ClientController@checkoutLayout')->name('checkout.layout');
Route::get('/home/hotdeals','ClientController@hotdealsLayout')->name('hotdeals.layout');
Route::get('/home/detail/{id}','ClientController@detail')->name('detail.layout');
Route::get('/home/viewcart','ClientController@viewCart')->name('viewcart.layout');
Route::post('/home/viewcart/update/{id}','ClientController@updateCart')->name('viewcart.update');
Route::get('/home/order/{id}','ClientController@viewOrder')->name('order.layout');
Route::get('/home/{id}','ClientController@indexCategory')->name('index.category');

Route::get('/home/{id}/add-to-cart/','ClientController@addtocart')->name('add-to-cart');
Route::delete('/home/{id}/add-to-cart/','ClientController@deleteItemCart')->name('delete_item-cart');

//Route pay
Route::post('home/invoice/store','InvoiceController@store')->name('invoice.store');
Route::get('home/detailOder/{id}','DetailOderController@storeDetailOder')->name('detailOder.store');

Route::group(['middleware' => 'auth'], function () {

    //Route items
    Route::get('/items','ItemController@index')->name('items.index');
    Route::post('/items','ItemController@store')->name('items.store');
    Route::get('/items/create','ItemController@create')->name('items.create');
    Route::get('/items/{id}/edit', 'ItemController@edit')->name('items.edit');
    Route::put('/items/{id}', 'ItemController@update')->name('items.update');
    Route::delete('/items/{id}', 'ItemController@destroy')->name('items.destroy');

    //Route invoice
    Route::get('/invoice','InvoiceController@index')->name('invoices.index');

    //Route categories
    Route::get('/categories','CategoryController@index')->name('categories.index');
    Route::post('/categories','CategoryController@store')->name('categories.store');
    Route::get('/categories/create','CategoryController@create')->name('categories.create');
    Route::get('/categories/{id}/edit', 'CategoryController@edit')->name('categories.edit');
    Route::put('/categories/{id}', 'CategoryController@update')->name('categories.update');
    Route::delete('/categories/{id}', 'CategoryController@destroy')->name('categories.destroy');
    //Route collection
    Route::get('/collections','CollectionController@index')->name('collections.index');
    Route::post('/collections','CollectionController@store')->name('collections.store');
    Route::get('/collections/create','CollectionController@create')->name('collections.create');
    Route::get('/collections/{id}/edit', 'CollectionController@edit')->name('collections.edit');
    Route::put('/collections/{id}', 'CollectionController@update')->name('collections.update');
    Route::delete('/collections/{id}', 'CollectionController@destroy')->name('collections.destroy');
    //Route invoice
    Route::get('/invoices','InvoiceController@index')->name('invoices.index');
    
    //Route profile
    Route::get('/profile','UserController@profile')->name('user.profile');
    Route::put('/profile', 'UserController@updateProfile')->name('user.update-profile');
    //Route password
    Route::get('/changepassword','UserController@password')->name('user.password');
    Route::put('/changepassword','UserController@changePassword')->name('user.change-password');

    //Route dashboard
    Route::get('/','PageController@dashboard')->name('dashboard');
});


