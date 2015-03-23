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
Route::get('agents/{location}',array('as' => 'agents', 'uses' => 'PagesController@agents'));
Route::get('rent',array('as' => 'rent', 'uses' => 'PagesController@rent'));
Route::get('sale',array('as' => 'sale', 'uses' => 'PagesController@sale'));
Route::post('newsletter',array('as' => 'newsletter', 'uses' => 'PagesController@newsletter'));
Route::post('newsletter_email_check',array('as' => 'newsletter_email_check', 'uses' => 'PagesController@newsletter_email_check'));


Route::get('create', array('as' => 'create', 'uses' => 'UsersController@create'));
Route::post('/store', array('as' => 'store', 'uses' => 'UsersController@store'));
Route::get('login', array('as' => 'login', 'uses' => 'UsersController@login'));
Route::post('/login', array('as' => 'login', 'uses' => 'UsersController@handleLogin'));
Route::get('/profile', array('before' => 'auth', 'as' => 'profile', 'uses' => 'UsersController@profile'));
Route::post('/profile/update', array('before' => 'auth', 'as' => 'profile.update', 'uses' => 'UsersController@update'));
Route::get('/profile/changepassword', array('before' => 'auth', 'as' => 'profile.changepassword', 'uses' => 'UsersController@changepassword'));
Route::post('/profile/do_changepassword', array('before' => 'auth', 'as' => 'profile.do_changepassword', 'uses' => 'UsersController@do_changepassword'));
Route::get('/profile/profileimage', array('before' => 'auth', 'as' => 'profile.profileimage', 'uses' => 'UsersController@profileimage'));
Route::post('/profile/changeprofileimage', array('before' => 'auth', 'as' => 'profile.changeprofileimage', 'uses' => 'UsersController@changeprofileimage'));
Route::get('/profile/bannerimage', array('before' => 'auth', 'as' => 'profile.bannerimage', 'uses' => 'UsersController@bannerimage'));
Route::post('/profile/changebannerimage', array('before' => 'auth', 'as' => 'profile.changebannerimage', 'uses' => 'UsersController@changebannerimage'));
Route::get('/profile/userimages', array('before' => 'auth', 'as' => 'profile.userimages', 'uses' => 'UsersController@userimages'));

Route::get('/logout', array('as' => 'logout', 'uses' => 'UsersController@logout'));
Route::get('/locationlist/{id}', array('as' => 'locationlist', 'uses' => 'PagesController@getlocation'));


Route::get('/wi', function(){/*dd(new WideImage);*/});
Route::get('/mail_test', array('as' => 'mail_test', 'uses' => 'UsersController@mail_test'));


Route::get('/dashboard', array('as' => 'dashboard', 'uses' => 'PagesController@dashboard'));

Route::get('/download/{type}/{file}', array('before' => 'auth','as' => 'download', 'uses' => 'DownloadController@get'));


Route::get('properties/{title}', array('as' => 'property.details', 'uses' => 'PropertiesController@details'));
Route::get('agent/{title}', array('as' => 'property.agent', 'uses' => 'PropertiesController@agent'));
Route::get('property/create', array('as' => 'property.create', 'uses' => 'PropertiesController@create'));
Route::post('property/store', array('as' => 'property.store', 'uses' => 'PropertiesController@store'));
Route::get('property/mylist/{id}', array('as' => 'property.mylist', 'uses' => 'PropertiesController@mylist'));
Route::get('property/show/{id}', array('as' => 'property.show', 'uses' => 'PropertiesController@show'));
Route::get('property/edit/{id}', array('as' => 'property.edit', 'uses' => 'PropertiesController@edit'));
Route::post('property/update/{id}', array('as' => 'property.update', 'uses' => 'PropertiesController@update'));
Route::get('property/search', array('as' => 'property.search', 'uses' => 'PropertiesController@search'));
Route::post('property/extend', array('before' => 'auth','as' => 'property.extend', 'uses' => 'PropertiesController@date_extend'));
Route::post('property/get_groups', array('before' => 'auth','as' => 'property.get_groups', 'uses' => 'PropertiesController@get_groups'));
Route::get('property/myproperties/', array('as' => 'property.myproperties', 'uses' => 'PropertiesController@myproperties'));
Route::post('property/propertyimage/', array('as' => 'property.propertyimage', 'uses' => 'PropertiesController@propertyimage'));
Route::get('property/change_status/{action}/{id}', array('as' => 'property.change_status', 'uses' => 'PropertiesController@change_status'));

Route::get('tenancy/create', array('as' => 'tenancy.create', 'uses' => 'TenancyController@create'));
Route::post('tenancy/store', array('as' => 'tenancy.store', 'uses' => 'TenancyController@store'));
Route::get('tenancy/tenancies', array('as' => 'tenancy.tenancies', 'uses' => 'TenancyController@tenancies'));
Route::get('tenancy/edit/{id}', array('as' => 'tenancy.edit', 'uses' => 'TenancyController@edit'));
Route::post('tenancy/update/{id}', array('as' => 'tenancy.update', 'uses' => 'TenancyController@update'));
Route::get('tenancy/transaction/{id}', array('as' => 'tenancy.transaction', 'uses' => 'TenancyController@transaction'));
Route::post('tenancy/transactionsave/{id}', array('as' => 'tenancy.transactionsave', 'uses' => 'TenancyController@transactionsave'));
Route::post('tenancy/adddocument', array('as' => 'tenancy.adddocument', 'uses' => 'TenancyController@adddocument'));
Route::get('tenancy/alert', array('as' => 'tenancy.alert', 'uses' => 'TenancyController@mail_alert'));
Route::post('tenancy/addvendor/{id}', array('as' => 'tenancy.addvendor', 'uses' => 'TenancyController@addvendor'));
Route::get('transaction/list', array('as' => 'tenancy.transaction_list', 'uses' => 'TenancyController@transaction_list'));
Route::get('transaction/edit/{id}', array('as' => 'tenancy.transaction_edit', 'uses' => 'TenancyController@transaction_edit'));
Route::get('vendor/list', array('as' => 'tenancy.vendor_list', 'uses' => 'TenancyController@vendor_list'));
Route::get('vendor/create', array('as' => 'tenancy.vendor_create', 'uses' => 'TenancyController@vendor_create'));
Route::get('vendor/edit/{id}', array('as' => 'tenancy.vendor_edit', 'uses' => 'TenancyController@vendor_edit'));
Route::get('vendor/save/{id}', array('as' => 'tenancy.savevendor', 'uses' => 'TenancyController@savevendor'));
Route::post('vendor/updatevendor/', array('as' => 'tenancy.updatevendor', 'uses' => 'TenancyController@updatevendor'));
/*
Route::get('admin/dashboard', array('as' => 'admin.dashboard', 'uses' => 'AdminsController@dashboard'));
Route::get('admin/attribute/relation', array('as' => 'attribute.relation', 'uses' => 'AttributesController@relation'));
Route::post('admin/attribute/store', array('as' => 'attribute.store', 'uses' => 'AttributesController@store'));
Route::get('admin/location/location', array('as' => 'location.location', 'uses' => 'LocationsController@location'));
Route::post('admin/location/addlocation', array('as' => 'location.addlocation', 'uses' => 'LocationsController@addlocation'));
Route::post('admin/location/addsublocation', array('as' => 'location.addsublocation', 'uses' => 'LocationsController@addsublocation'));
Route::get('admin/location/transport', array('as' => 'location.transport', 'uses' => 'LocationsController@transport'));
Route::post('admin/location/addgroup', array('as' => 'location.addgroup', 'uses' => 'LocationsController@addgroup'));
Route::post('admin/location/addtransport', array('as' => 'location.addtransport', 'uses' => 'LocationsController@addtransport'));
Route::get('admin/location/nearby', array('as' => 'location.nearby', 'uses' => 'LocationsController@nearby'));
Route::post('admin/location/addnearbygroup', array('as' => 'location.addnearbygroup', 'uses' => 'LocationsController@addnearbygroup'));
Route::post('admin/location/addnearby', array('as' => 'location.addnearby', 'uses' => 'LocationsController@addnearby'));
Route::post('admin/location/update_transport', array('as' => 'location.update_transport', 'uses' => 'LocationsController@update_transport'));
Route::get('admin/get_transport_tree/{type}', array('as' => 'location.get_transport_tree', 'uses' => 'LocationsController@get_transport_tree'));
Route::get('admin/property/list', array('as' => 'admin.property.list', 'uses' => 'AdminsController@property_list'));
Route::post('admin/property/activate', array('as' => 'admin.property.activate', 'uses' => 'AdminsController@property_activate'));
Route::get('admin/users/list', array('as' => 'admin.users.list', 'uses' => 'AdminsController@user_list'));
Route::get('admin/user/changestatus/{id}', array('as' => 'admin.user.changestatus', 'uses' => 'AdminsController@userchangestatus'));
*/
//Route::get('admin', array('as' => 'admin.login', 'uses' => 'AdminsController@index'));
Route::group(['prefix' => 'admins'], function() {

    //Route::get('/', ''); 
    Route::get('/', array('as' => 'admin.signin', 'uses' => 'AdminsController@index'));
    Route::post('/login',array('as' => 'admin.login', 'uses' => 'AdminsController@login')) ; 
    Route::get('/logout',array('as' => 'admin.logout', 'uses' => 'AdminsController@logout')) ; 
	Route::get('/dashboard', array('as' => 'admins.dashboard', 'uses' => 'AdminsController@dashboard'));
	Route::get('/attribute/relation', array('as' => 'attribute.relation', 'uses' => 'AdminsAttributesController@relation'));
	Route::post('/attribute/store', array('as' => 'attribute.store', 'uses' => 'AdminsAttributesController@store'));
	Route::get('/location/location', array('as' => 'location.location', 'uses' => 'AdminsLocationsController@location'));
	Route::post('/location/addlocation', array('as' => 'location.addlocation', 'uses' => 'AdminsLocationsController@addlocation'));
	Route::post('/location/addsublocation', array('as' => 'location.addsublocation', 'uses' => 'AdminsLocationsController@addsublocation'));
	Route::get('/location/transport', array('as' => 'location.transport', 'uses' => 'AdminsLocationsController@transport'));
	Route::post('/location/addgroup', array('as' => 'location.addgroup', 'uses' => 'AdminsLocationsController@addgroup'));
	Route::post('/location/addtransport', array('as' => 'location.addtransport', 'uses' => 'AdminsLocationsController@addtransport'));
	Route::get('/location/nearby', array('as' => 'location.nearby', 'uses' => 'AdminsLocationsController@nearby'));
	Route::post('/location/addnearbygroup', array('as' => 'location.addnearbygroup', 'uses' => 'AdminsLocationsController@addnearbygroup'));
	Route::post('/location/addnearby', array('as' => 'location.addnearby', 'uses' => 'AdminsLocationsController@addnearby'));
	Route::post('/location/update_transport', array('as' => 'location.update_transport', 'uses' => 'AdminsLocationsController@update_transport'));
	Route::post('/location/update_location', array('as' => 'location.update_location', 'uses' => 'AdminsLocationsController@update_location'));
	Route::get('/get_transport_tree/{type}', array('as' => 'location.get_transport_tree', 'uses' => 'AdminsLocationsController@get_transport_tree'));
	Route::get('/get_location_tree/', array('as' => 'location.get_location_tree', 'uses' => 'AdminsLocationsController@get_location_tree'));
	Route::get('/property/list', array('as' => 'admin.property.list', 'uses' => 'AdminsController@property_list'));
	Route::post('/property/activate', array('as' => 'admin.property.activate', 'uses' => 'AdminsController@property_activate'));
	Route::get('/users/list', array('as' => 'admin.users.list', 'uses' => 'AdminsController@user_list'));
	Route::get('/user/changestatus/{id}', array('as' => 'admin.user.changestatus', 'uses' => 'AdminsController@userchangestatus'));
	Route::get('/user/changefeatured/{id}', array('as' => 'admin.user.changefeatured', 'uses' => 'AdminsController@userchangefeatured'));

	Route::get('/relation/', array('as' => 'admin.relation.', 'uses' => 'AdminsRelationController@index'));	
	Route::post('/relation/save_deal', array('as' => 'admin.save_deal', 'uses' => 'AdminsRelationController@save_deal'));	
	Route::post('/relation/save_group', array('as' => 'admin.save_group', 'uses' => 'AdminsRelationController@save_group'));	
	Route::post('/relation/save_type', array('as' => 'admin.save_type', 'uses' => 'AdminsRelationController@save_type'));	
	Route::post('/relation/save_attribute', array('as' => 'admin.save_attribute', 'uses' => 'AdminsRelationController@save_attribute'));	
	Route::get('/get_deals_tree/', array('as' => 'admin.get_deals_tree.', 'uses' => 'AdminsRelationController@get_deals_tree'));	
	Route::get('/get_types_tree/', array('as' => 'admin.get_types_tree.', 'uses' => 'AdminsRelationController@get_types_tree'));	
	Route::get('/get_groups_tree/', array('as' => 'admin.get_groups_tree.', 'uses' => 'AdminsRelationController@get_groups_tree'));	
	Route::get('/get_attributes_tree/', array('as' => 'admin.get_attributes_tree.', 'uses' => 'AdminsRelationController@get_attributes_tree'));	
	
	Route::get('/newsletters/', array('as' => 'admin.newsletters.', 'uses' => 'AdminsController@newsletters'));	

});

