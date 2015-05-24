<?php

//Dashboard sin login
Route::get('/', array('as' => 'dashboard', 'uses' => 'Admin\DashboardController@inicio'));

//Login
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//Admin
Route::group(array('prefix' => 'admin', 'middleware' => 'auth'), function(){

	//Dashboard
	Route::get('admin/index', array('as' => 'dashboard', 'uses' => 'Admin\DashboardController@index'));

	//Users
	Route::resource('users', 'Admin\UsersController');
	Route::post('users/delete', array('as' => 'admin.users.delete', 'uses' => 'Admin\UsersController@delete'));
    //Roles
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles/delete', array('as' => 'admin.roles.delete', 'uses' => 'Admin\RolesController@delete'));

});

//Api
Route::group(array('prefix' => 'api', 'middleware' => 'allowOrigin'), function() {

	//Users
	Route::resource('users', 'Api\UsersController', ['only' => ['index', 'show']]);

});