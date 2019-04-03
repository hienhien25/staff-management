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


Route::get('/','PageController@index')->name('home');
Route::get('adminlogin','PageController@getlogin')->name('adminlogin');
Route::post('adminlogin','PageController@postlogin')->name('adminlogin');
Route::get('register','PageController@getregister')->name('register');
Route::post('register','PageController@postregister')->name('register');
Route::group(['prefix'=>'admin'],function(){
	Route::get('DepartmentList','DepartmentController@showlist')->name('admin.DepartmentList');
	Route::get('addDepartment','DepartmentController@getadd')->name('admin.addDepartment');
	Route::post('addDepartment','DepartmentController@postadd')->name('admin.addDepartment');
	Route::get('PositionList/{id}.html','DepartmentController@showlistposition')->name('admin.PositionList');
	Route::get('StaffList/{id}.html','PositionController@showstafflist')->name('admin.Position.StaffList');
	Route::get('addPosition','PositionController@getadd')->name('admin.addPosition');
	Route::post('addPosition','PositionController@postadd')->name('admin.addPosition');
	Route::get('deletePosition/{id}.html','PositionController@getdelete')->name('admin.deletePosition');
	Route::get('UserList','UserController@showlist')->name('admin.UserList');
	Route::get('addStaff','UserController@getadd')->name('admin.user.addstaff');
	Route::post('addStaff','UserController@postadd')->name('admin.user.addstaff');
	Route::get('editStaff/{id}.html','UserController@getedit')->name('admin.user.editStaff');
	Route::post('editStaff/{id}.html','UserController@edit')->name('admin.user.editStaff');
	Route::get('deleteStaff/{id}.html','UserController@getdelete')->name('admin.user.deleteStaff');
	Route::get('Profile/{id}.html','UserController@getprofile')->name('profile');
	Route::post('Profile/{id}.html','UserController@updateprofile')->name('profile');
});
