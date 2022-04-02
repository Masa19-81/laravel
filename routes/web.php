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

Auth::routes();

Route::get('/', 'ItemController@index')->name('index');
Route::get('/item/detail/{id}', 'ItemController@detail')->name('detail');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'cart', 'middleware' => 'auth:user'], function() {
	Route::get('index', 'Auth\CartController@index')->name('cart.index');
	Route::post('add', 'Auth\CartController@add')->name('cart.add');
	Route::post('delete', 'Auth\CartController@delete')->name('cart.delete');
});

Route::group(['prefix' => 'address', 'middleware' => 'auth:user'], function() {
	Route::get('index', 'Auth\UserAddressController@index')->name('address.index');
	Route::get('select', 'Auth\UserAddressController@select')->name('address.select');
	Route::get('add', function () { return view('address.add'); })->name('address.add');
	Route::post('add', 'Auth\UserAddressController@add')->name('address.add_post');
	Route::get('edit/{id}', 'Auth\UserAddressController@edit')->name('address.edit');
	Route::post('edit', 'Auth\UserAddressController@update')->name('address.update');
	Route::post('delete', 'Auth\UserAddressController@delete')->name('address.delete');
});

Route::group(['prefix' => 'admin'], function() {
	Route::get('/', function () { return redirect('/admin/home'); });
	Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\LoginController@login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
	Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
	Route::get('home', 'Admin\HomeController@index')->name('admin.home');
	Route::get('index', 'Admin\ItemController@index')->name('admin.index');
	Route::get('detail/{id}', 'Admin\ItemController@detail')->name('admin.detail');
	Route::get('edit/{id}', 'Admin\ItemController@edit')->name('admin.edit');
	Route::post('edit', 'Admin\ItemController@update')->name('admin.update');
	Route::get('add', function () { return view('admin.add'); })->name('admin.add');
	Route::post('add', 'Admin\ItemController@add')->name('admin.add_post');
});
