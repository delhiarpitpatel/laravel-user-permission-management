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

Route::get('/', function () { 
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	
	Route::put('user/groups/update','UserController@update_users_group')->name('user/groups/update');
	
	Route::get('user/groups/manage','UserGroupsController@manage')->name('user/groups/manage');
	Route::get('user/groups/add','UserGroupsController@addForm')->name('user/groups/add');
	Route::put('user/groups/_add','UserGroupsController@add')->name('user/groups/_add');
	
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('user/register','UserController@registerForm')->name('user/register');
	Route::put('user/_register','UserController@register')->name('user/_register');
	
	Route::get('module/manage','ModulesController@manage')->name('module/manage');
	Route::get('module/add','ModulesController@addForm')->name('module/add');
	Route::put('module/_add','ModulesController@add')->name('module/_add');	
	
	Route::resource('settings', 'SettingsController', ['except' => ['show']]);
	Route::post('update_settings', 'SettingsController@update_submitted')->name('update_settings');	
	Route::get('settings/permissions', 'SettingsController@permissions')->name('settings/permissions');
	Route::post('settings/permissions/update', 'SettingsController@update_permissions')->name('settings/permissions/update');	
	
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

