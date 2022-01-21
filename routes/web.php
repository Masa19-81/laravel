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
