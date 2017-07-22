<?php

// Home

Route::group(['middleware' => ['web']], function () 
{
	Route::get('home', [
		'as'	=>	'home',
		'uses' 	=>	'HomeController@home'
	]);

	Route::get('contact', [
		'as'	=>	'contact',
		'uses' 	=>	'ContactController@contact'
	]);

	Route::post('contact', [
		'as'	=>	'contact',
		'uses' 	=>	'ContactController@contactForm'
	]);

	Route::get('restaurants', [
		'as'	=>	'restaurants',
		'uses' 	=>	'HomeController@restaurants'
	]);

});


// Dashboard

Route::group(['middleware' => ['web']], function () 
{
	Route::get('dashboard/{id}', [
		
		'as'	=>	'dashboard',
		'uses' 	=>	'DashboardController@dashboard'
	]);

	Route::get('individualFood', [
		'as'	=>	'individualFood',
		'uses' 	=>	'DashboardController@individualFoodStat'
	]);

	Route::get('priceStat', [
		'as'	=>	'priceStat',
		'uses'	=>	'DashboardController@priceStat'
	]);

	Route::get('allRestaurant', [
		'as'	=>	'allRestaurant',
		'uses' 	=>	'DashboardController@restaurantStat'
	]);

	Route::get('singleCategory/{id}', [
		'as'	=>	'singleCategory',
		'uses'	=>	'DashboardController@singleCategory'
	]);
});



//  For Site Admin

Route::group(['middleware' => ['web']], function () 
{

	Route::get('orderList', [
		'as'	=>	'orderList',
		'uses' 	=>	'AdminController@orderlist'
	]);

	Route::get('ordervalidity/{id}', [
		'as'	=>	'ordervalidity',
		'uses' 	=>	'AdminController@ordervalidity'
	]);

	Route::get('ordercancel/{id}', [
		'as'	=>	'ordercancel',
		'uses' 	=>	'AdminController@orderCancel'
	]);

	Route::get('blacklist', [
		'as'	=>	'blacklist',
		'uses' 	=>	'AdminController@blackList'
	]);

	Route::get('pendinglist', [
		'as'	=>	'pendinglist',
		'uses' 	=>	'AdminController@pendingList'
	]);

	Route::get('deliverer', [
		'as'	=>	'deliverer',
		'uses' 	=>	'AdminController@deliverer'
	]);

	Route::get('restaurantStatistics', [
		'as'	=>	'restaurantStatistics',
		'uses' 	=>	'AdminController@restaurantstatistics'
	]);
});



// User Registration

Route::group(['middleware' => ['web']], function () 
{
	Route::get('registration', [
		'as'	=>	'registration',
		'uses' 	=>	'RegistrationController@registration'
	]);

	Route::post('registration', [
		'as'	=>	'registration',
		'uses' 	=>	'RegistrationController@registrationForm'
	]);
});

// User LogIn & LogOut

Route::get('/authme/{id}', function($id){
	Auth::login(\App\User::find($id));
	return Auth::user();
});

Route::group(['middleware' => ['web']], function () 
{
	Route::get('login', [
		'as'	=>	'login',
		'uses' 	=>	'LoginController@login'
	]);

	Route::post('login', [
		'as'	=>	'login',
		'uses' 	=>	'LoginController@loginForm'
	]);

	Route::get('logout', [
		'as'	=>	'logout',
		'uses' 	=>	'LoginController@logout'
	]);
});

//  Restaurant Information Update

Route::group(['middleware' => ['web']], function () 
{
	Route::get('restaurant_info_create/{id}', [
		'as'	=>	'restaurant_info_create',
		'uses' 	=>	'RestaurantInfoController@restaurantInfo'
	]);

	Route::post('restaurant_info_create/{id}', [
		'as'	=>	'restaurant_info_create',
		'uses' 	=>	'RestaurantInfoController@restaurantInfoSubmit'
	]);
});

//  Search Restaurant

Route::group(['middleware' => ['web']], function () 
{
	Route::post('searchRestaurant', [
		'as'	=>	'searchRestaurant',
		'uses' 	=>	'SearchController@restaurantSearch'
	]);

	Route::get('searchFood/{id}', [
		'as'	=>	'searchFood',
		'uses' 	=>	'SearchController@foodSearch'
	]);
});

// Order Routes

Route::group(['middleware' => ['web']], function () 
{
	Route::get('orderFood/{id}', [
		'as'	=>	'orderFood',
		'uses' 	=>	'OrderController@foodOrder'
	]);

	Route::post('orderComplete/{id}', [
		'as'	=>	'orderComplete',
		'uses' 	=>	'OrderController@orderForm'
	]);

	Route::get('checkout/{id}', [
		'as'	=>	'checkout',
		'uses' 	=>	'OrderController@checkout'
	]);

	Route::get('removeblacklist/{id}/{restaurantId}', [
		'as'	=>	'removeblacklist',
		'uses' 	=>	'OrderController@removeBlacklist'
	]);
});

// food item create, update & delete

Route::group(['middleware' => ['web']], function () 
{
	Route::get('foodUpdate/{id}', [
		'as'	=>	'foodUpdate',
		'uses' 	=>	'DashboardController@foodUpdate'
	]);

	Route::post('foodUpdate/{id}', [
		'as'	=>	'foodUpdate',
		'uses' 	=>	'DashboardController@foodUpdateForm'
	]);

	Route::get('foodDelete/{id}', [
		'as'	=>	'foodDelete',
		'uses' 	=>	'DashboardController@foodDelete'
	]);

	Route::get('newfood', [
		'as'	=>	'newfood',
		'uses' 	=>	'DashboardController@foodCreate'
	]);

	Route::post('foodCreate/{id}', [
		'as'	=>	'foodCreate',
		'uses' 	=>	'DashboardController@foodCreateForm'
	]);
});

// new category create

Route::group(['middleware' => ['web']], function () 
{
	Route::get('newCategory', [
		'as'	=>	'newCategory',
		'uses' 	=>	'DashboardController@categoryCreate'
	]);

	Route::post('categoryCreate/{id}', [
		'as'	=>	'categoryCreate',
		'uses' 	=>	'DashboardController@categoryCreateForm'
	]);
});