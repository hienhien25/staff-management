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


// Login and logout
Route::get('admin-login','PageController@getLogin')->name('adminLogin');
Route::post('admin-login','PageController@postLogin')->name('adminLogin');
Route::get('logout','PageController@logout')->name('logout');
Route::get('update-profile/{token}.html','ProfileController@getUpdate')->name('admin.updateProfile');
Route::post('update-profile','ProfileController@postUpdate')->name('admin.updateProfile');
Route::group(['prefix'=>'password'],function(){
	Route::post('create-password','PasswordController@create')->name('password.createPassword');
	Route::get('reset-password/{token}.html','PasswordController@getReset')->name('password.resetPassword');
	Route::post('reset-password','PasswordController@postResset')->name('password.resetPassword');
});
Route::get('forgot-password','PasswordController@getForgot')->name('forgotPassword');
Route::group(['prefix'=>'admin','middleware'=>['admin_login']],function(){
	//Home
	Route::get('/','PageController@index')->name('home');
	//Department
	Route::get('department-list','DepartmentController@showList')->name('admin.departmentList');
	Route::get('add-department','DepartmentController@getAdd')->name('admin.addDepartment');
	Route::post('add-department','DepartmentController@postAdd')->name('admin.addDepartment');
	Route::get('delete-department/{id}.html','DepartmentController@getDelete')->name('admin.deleteDepartment');
	Route::get('export-department-list-to-excel','DepartmentController@export')->name('exportDepartment');
	//Position
	Route::get('position-list/{id}.html','DepartmentController@showListPosition')->name('admin.positionList');
	Route::get('staff-list/{id}.html','PositionController@showStaffList')->name('admin.position.staffList');
	Route::get('add-position','PositionController@getAdd')->name('admin.addPosition');
	Route::post('add-position','PositionController@postAdd')->name('admin.addPosition');
	Route::get('delete-position/{id}.html','PositionController@getDelete')->name('admin.deletePosition');
	//User 
	Route::get('user-list','UserController@showList')->name('admin.userList');
	Route::get('add-staff','UserController@getAdd')->name('admin.user.addStaff');
	Route::post('add-staff','UserController@postAdd')->name('admin.user.addStaff');
	Route::get('edit-staff/{id}.html','UserController@getEdit')->name('admin.user.editStaff');
	Route::post('edit-staff/{id}.html','UserController@postEdit')->name('admin.user.editStaff');
	Route::get('delete-staff/{id}.html','UserController@getDelete')->name('admin.user.deleteStaff');
	//Ajax
	Route::get('ajax-department/{iddepartment}','AjaxController@getDepartment')->name('admin.ajaxDepartment');
	//Profile
	Route::get('profile/{id}.html','UserController@getProfile')->name('profile');
	Route::post('profile/{id}.html','UserController@postEdit')->name('profile');
	//Checkin
	Route::get('checkin','CheckinController@getCheckin')->name('admin.checkin');
	Route::post('checkin','CheckinController@postCheckin')->name('admin.checkin');
	Route::get('show-checkin-list','CheckinController@showList')->name('admin.showCheckinList');
	Route::post('show-checkin-list','CheckinController@postShow')->name('admin.showCheckinList');
	//Checkout
	Route::get('checkout','CheckoutController@getCheckout')->name('admin.checkout');
	Route::get('edit-checkout/{id}.html','CheckinController@getEditCheckout')->name('admin.editCheckout');
	Route::post('edit-checkout/{id}.html','CheckinController@postEditCheckout')->name('admin.editCheckout');
	Route::get('delete-checkin/{id}.html','CheckinController@getDelete')->name('admin.deleteCheckin');
	//Mail
	Route::get('send-email','MailController@getSendMail')->name('admin.sendMail');
	Route::post('send-email','MailController@postSendMail')->name('admin.sendMail');
	// Regisster account by admin
	Route::get('add-member','UserController@getAddMember')->name('admin.addMember');
	Route::post('add-member','UserController@postAddMember')->name('admin.addMember');
	//Log 
	Route::get('log','LogController@getLog')->name('admin.log');
});
