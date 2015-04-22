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

// 
define("VALIDITY_DAYS", 90);
define("WARNING_DAYS", 30);

// Global location handler
$location_array = CommonHelper::getLocation();
foreach ($location_array as $key => $value) {
	$location_array[$key] = str_replace(' ','_', strtolower($value));
}
$location = Request::segment(1);
if(!in_array(strtolower($location), $location_array)){
	$location = '';
}
$location_id = array_search($location, $location_array);
define("LOCATION_ID", $location_id);
//echo LOCATION_ID;
Route::group(['prefix' => $location], function() {
	Route::resource('/', 'PagesController');
	
	Route::get('about', array('as' => 'about', 'uses' => 'PagesController@about'));
	Route::get('contact', array('as' => 'contact', 'uses' => 'PagesController@contact'));
	Route::get('privacy_policy', array('as' => 'privacy_policy', 'uses' => 'PagesController@privacy_policy'));
	Route::get('terms_n_conditions', array('as' => 'terms_n_conditions', 'uses' => 'PagesController@terms_n_conditions'));
	
	
	Route::get('rent',array('as' => 'rent', 'uses' => 'PagesController@rent'));
	Route::get('sale',array('as' => 'sale', 'uses' => 'PagesController@sale'));
	Route::post('newsletter',array('as' => 'newsletter', 'uses' => 'PagesController@newsletter'));
	Route::post('newsletter_email_check',array('as' => 'newsletter_email_check', 'uses' => 'PagesController@newsletter_email_check'));
	
	Route::get('agents/{location_name}',array('as' => 'agents', 'uses' => 'UsersController@agents'));
	Route::get('agent/{title}', array('as' => 'property.agent', 'uses' => 'UsersController@agent'));
	
	Route::get('create', array('as' => 'create', 'uses' => 'UsersController@create'));
	Route::post('/store', array('as' => 'store', 'uses' => 'UsersController@store'));
	Route::get('email_verification/{token}', array('as' => 'email_verification', 'uses' => 'UsersController@email_verification'));
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
	Route::post('userimagecreate',array('as' => 'userimagecreate', 'uses' => 'UsersController@userimagecreate'));
	
	Route::get('/logout', array('as' => 'logout', 'uses' => 'UsersController@logout'));
	Route::post('forgotpassword', array('as' => 'forgotpassword', 'uses' => 'UsersController@forgotpassword'));
	Route::get('/locationlist/{id}', array('as' => 'locationlist', 'uses' => 'PagesController@getlocation'));
	Route::get('/reset_password/{id}/{code}', array('as' => 'reset_password', 'uses' => 'UsersController@reset_password'));
	Route::post('/do_reset_password', array('as' => 'do_reset_password', 'uses' => 'UsersController@do_reset_password'));
	
	
	Route::get('/wi', function(){/*dd(new WideImage);*/});
	Route::get('/mail_test', array('as' => 'mail_test', 'uses' => 'UsersController@mail_test'));
	
	
	Route::get('/dashboard', array('as' => 'dashboard', 'uses' => 'PagesController@dashboard'));
	
	Route::get('/download/{type}/{file}', array('before' => 'auth','as' => 'download', 'uses' => 'DownloadController@get'));
	
	
	Route::get('properties/{title}', array('as' => 'property.details', 'uses' => 'PropertiesController@details'));
	
	Route::get('property/create', array('before' => 'auth', 'as' => 'property.create', 'uses' => 'PropertiesController@create'));
	Route::post('property/store', array('before' => 'auth', 'as' => 'property.store', 'uses' => 'PropertiesController@store'));
	//Route::get('property/mylist/{id}', array('as' => 'property.mylist', 'uses' => 'PropertiesController@mylist'));
	Route::get('property/show/{id}', array('as' => 'property.show', 'uses' => 'PropertiesController@show'));
	Route::get('property/edit/{id}', array('before' => 'auth', 'as' => 'property.edit', 'uses' => 'PropertiesController@edit'));
	Route::post('property/update/{id}', array('before' => 'auth', 'as' => 'property.update', 'uses' => 'PropertiesController@update'));
	Route::get('property/search', array('as' => 'property.search', 'uses' => 'PropertiesController@search'));
	Route::post('property/extend', array('before' => 'auth', 'before' => 'auth','as' => 'property.extend', 'uses' => 'PropertiesController@date_extend'));
	Route::post('property/get_groups', array('before' => 'auth','as' => 'property.get_groups', 'uses' => 'PropertiesController@get_groups'));
	Route::get('property/myproperties/', array('before' => 'auth', 'as' => 'property.myproperties', 'uses' => 'PropertiesController@myproperties'));
	Route::post('property/propertyimage/', array('before' => 'auth', 'as' => 'property.propertyimage', 'uses' => 'PropertiesController@propertyimage'));
	Route::get('property/change_status/{action}/{id}', array('as' => 'property.change_status', 'uses' => 'PropertiesController@change_status'));
	
	Route::get('tenancy/create', array('before' => 'auth', 'as' => 'tenancy.create', 'uses' => 'TenancyController@create'));
	Route::post('tenancy/store', array('before' => 'auth', 'as' => 'tenancy.store', 'uses' => 'TenancyController@store'));
	Route::get('tenancy/tenancies', array('before' => 'auth', 'as' => 'tenancy.tenancies', 'uses' => 'TenancyController@tenancies'));
	Route::get('tenancy/edit/{id}', array('before' => 'auth', 'as' => 'tenancy.edit', 'uses' => 'TenancyController@edit'));
	Route::post('tenancy/update/{id}', array('before' => 'auth', 'as' => 'tenancy.update', 'uses' => 'TenancyController@update'));
	Route::get('tenancy/transaction/{id}', array('before' => 'auth', 'as' => 'tenancy.transaction', 'uses' => 'TenancyController@transaction'));
	Route::post('tenancy/transactionsave/{id}', array('before' => 'auth', 'as' => 'tenancy.transactionsave', 'uses' => 'TenancyController@transactionsave'));
	Route::post('tenancy/adddocument', array('before' => 'auth', 'as' => 'tenancy.adddocument', 'uses' => 'TenancyController@adddocument'));
	Route::get('tenancy/alert', array('as' => 'tenancy.alert', 'uses' => 'TenancyController@mail_alert'));
	Route::post('tenancy/addvendor/{id}', array('before' => 'auth', 'as' => 'tenancy.addvendor', 'uses' => 'TenancyController@addvendor'));
	Route::get('transaction/list', array('before' => 'auth', 'as' => 'tenancy.transaction_list', 'uses' => 'TenancyController@transaction_list'));
	Route::get('transaction/edit/{id}', array('before' => 'auth', 'as' => 'tenancy.transaction_edit', 'uses' => 'TenancyController@transaction_edit'));
	Route::get('vendor/list', array('before' => 'auth', 'as' => 'tenancy.vendor_list', 'uses' => 'TenancyController@vendor_list'));
	Route::get('vendor/create', array('before' => 'auth', 'as' => 'tenancy.vendor_create', 'uses' => 'TenancyController@vendor_create'));
	Route::get('vendor/edit/{id}', array('before' => 'auth', 'as' => 'tenancy.vendor_edit', 'uses' => 'TenancyController@vendor_edit'));
	Route::get('vendor/save/{id}', array('before' => 'auth', 'as' => 'tenancy.savevendor', 'uses' => 'TenancyController@savevendor'));
	Route::post('vendor/updatevendor/', array('before' => 'auth', 'as' => 'tenancy.updatevendor', 'uses' => 'TenancyController@updatevendor'));
});

Route::group(['prefix' => 'admins'], function() {
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

	Route::get('/advertise/adpackages/', array('as' => 'admin.adpackages', 'uses' => 'AdminsAdsController@packages'));	
	Route::get('/advertise/adpackagesprice/{package_id}', array('as' => 'admin.adpackagesprice', 'uses' => 'AdminsAdsController@packagesprice'));	
	Route::post('/advertise/adpackages/save', array('as' => 'admin.adpackages.save', 'uses' => 'AdminsAdsController@save_package'));	
	Route::post('/advertise/adpackagesprice/save', array('as' => 'admin.adpackagesprice.price', 'uses' => 'AdminsAdsController@save_packagesprice'));	

	Route::post('/property_code_check/', array('as' => 'admin.property_code_check', 'uses' => 'AdminsAdsController@property_code_check'));	
	Route::get('/advertise/', array('as' => 'admin.ads', 'uses' => 'AdminsAdsController@index'));	
	Route::get('/get_advertise/', array('as' => 'admin.get_advertise', 'uses' => 'AdminsAdsController@get_advertise'));
	Route::post('/get_package_details/', array('as' => 'admin.get_package_details', 'uses' => 'AdminsAdsController@get_package_details'));


	Route::get('/add_advertise/', array('as' => 'admin.add_advertise', 'uses' => 'AdminsAdsController@add_advertise'));	
	Route::post('/save_advertise/', array('as' => 'admin.save_advertise', 'uses' => 'AdminsAdsController@save_advertise'));	
	Route::post('/deactivate_advertise/', array('as' => 'admin.deactivate_advertise', 'uses' => 'AdminsAdsController@deactivate_advertise'));	
	Route::post('/upload_advertise/', array('as' => 'admin.upload_advertise', 'uses' => 'AdminsAdsController@upload_advertise'));	
	Route::post('/password_check/', array('as' => 'admin.password_check', 'uses' => 'AdminsAdsController@password_check'));	

	Route::get('/recommendation/', array('as' => 'admin.recommendation', 'uses' => 'AdminsRecommendationsController@index'));	
	Route::get('/add_recommendation/', array('as' => 'admin.add_recommendation', 'uses' => 'AdminsRecommendationsController@add_recommendation'));	
	Route::post('/save_recommendation/', array('as' => 'admin.save_recommendation', 'uses' => 'AdminsRecommendationsController@save_recommendation'));	
	Route::post('/deactivate_recommendation/', array('as' => 'admin.deactivate_recommendation', 'uses' => 'AdminsRecommendationsController@deactivate_recommendation'));	
	Route::post('/upload_recommendation/', array('as' => 'admin.upload_recommendation', 'uses' => 'AdminsRecommendationsController@upload_recommendation'));	
	Route::get('/get_recommendation/', array('as' => 'admin.get_recommendation', 'uses' => 'AdminsRecommendationsController@get_recommendation'));
	
});

