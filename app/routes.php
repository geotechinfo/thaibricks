<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*Route::get('/', function()
{
	return View::make('index');
});*/

//Route::resource('/', 'AccountsController');
//Route::get('register', array('as' => 'register', 'uses' => 'AccountsController@register'));
//Route::post('register', array('as' => 'register', 'uses' => 'AccountsController@register'));
//Route::any('register', array('as' => 'register', 'uses' => 'AccountsController@register'));

Route::resource('/', 'PagesController');
Route::get('about', function(){ return View::make('pages.about'); });

Route::get('create', array('as' => 'create', 'uses' => 'UsersController@create'));
Route::post('/store', array('as' => 'store', 'uses' => 'UsersController@store'));
Route::get('login', array('as' => 'login', 'uses' => 'UsersController@login'));
Route::post('/login', array('as' => 'login', 'uses' => 'UsersController@handleLogin'));
Route::get('/profile', array('before' => 'auth', 'as' => 'profile', 'uses' => 'UsersController@profile'));
Route::get('/logout', array('as' => 'logout', 'uses' => 'UsersController@logout'));

Route::get('property/create', array('as' => 'property.create', 'uses' => 'PropertiesController@create'));
Route::post('property/store', array('as' => 'property.store', 'uses' => 'PropertiesController@store'));
Route::get('property/mylist/{id}', array('as' => 'property.mylist', 'uses' => 'PropertiesController@mylist'));
Route::get('property/show/{id}', array('as' => 'property.show', 'uses' => 'PropertiesController@show'));
Route::get('property/edit/{id}', array('as' => 'property.edit', 'uses' => 'PropertiesController@edit'));
Route::post('property/update/{id}', array('as' => 'property.update', 'uses' => 'PropertiesController@update'));
Route::get('property/search', array('as' => 'property.search', 'uses' => 'PropertiesController@search'));

Route::resource('admin', 'AdminsController');
Route::resource('admin/relation', 'RelationsController');
//Route::resource('admin/location', 'LocationsController');
Route::get('admin/location/location', array('as' => 'location.location', 'uses' => 'LocationsController@location'));
Route::post('admin/location/store', array('as' => 'location.store', 'uses' => 'LocationsController@store'));
Route::get('admin/location/transport', array('as' => 'location.transport', 'uses' => 'LocationsController@transport'));
Route::post('admin/location/save', array('as' => 'location.save', 'uses' => 'LocationsController@save'));