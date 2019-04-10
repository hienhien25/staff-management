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



Route::get('adminlogin','PageController@getlogin')->name('adminlogin');
Route::post('adminlogin','PageController@postlogin')->name('adminlogin');
Route::get('logout','PageController@logout')->name('logout');
Route::get('register','PageController@getregister')->name('register');
Route::post('register','PageController@postregister')->name('register');
Route::group(['prefix'=>'admin','middleware'=>['admin_login']],function(){
	Route::get('/','PageController@index')->name('home');
	Route::get('DepartmentList','DepartmentController@showlist')->name('admin.DepartmentList');
	Route::get('addDepartment','DepartmentController@getadd')->name('admin.addDepartment');
	Route::post('addDepartment','DepartmentController@postadd')->name('admin.addDepartment');
	Route::get('deletedepartment/{id}.html','DepartmentController@getdelete')->name('admin.deletedepartment');
	Route::get('PositionList/{id}.html','DepartmentController@showlistposition')->name('admin.PositionList');
	Route::get('StaffList/{id}.html','PositionController@showstafflist')->name('admin.Position.StaffList');
	Route::get('addPosition','PositionController@getadd')->name('admin.addPosition');
	Route::post('addPosition','PositionController@postadd')->name('admin.addPosition');
	Route::get('deletePosition/{id}.html','PositionController@getdelete')->name('admin.deletePosition');
	Route::get('UserList','UserController@showlist')->name('admin.UserList');
	Route::get('addStaff','UserController@getadd')->name('admin.user.addstaff');
	Route::post('addStaff','UserController@postadd')->name('admin.user.addstaff');
	Route::get('editStaff/{id}.html','UserController@getedit')->name('admin.user.editStaff');
	Route::post('editStaff/{id}.html','UserController@postedit')->name('admin.user.editStaff');
	Route::get('deleteStaff/{id}.html','UserController@getdelete')->name('admin.user.deleteStaff');
	Route::get('ajaxdepartment/{iddepartment}','AjaxController@getdepartment')->name('admin.ajaxdepartment');
	Route::get('Profile/{id}.html','UserController@getprofile')->name('profile');
	Route::post('Profile/{id}.html','UserController@postedit')->name('profile');
	Route::get('checkin','CheckinController@getcheckin')->name('admin.checkin');
	Route::post('checkin','CheckinController@postcheckin')->name('admin.checkin');
	Route::get('checkout','CheckinController@getcheckout')->name('admin.checkout');
	Route::post('checkout','CheckinController@postcheckout')->name('admin.checkout');
	Route::get('edit-checkout/{id}.html','CheckinController@geteditcheckout')->name('admin.editcheckout');
	Route::post('edit-checkout/{id}.html','CheckinController@posteditcheckout')->name('admin.editcheckout');
	Route::get('delete-checkin/{id}.html','CheckinController@getdelete')->name('admin.deleteCheckin');
	Route::get('send-email','MailController@getsendmail')->name('admin.sendmail');
	Route::post('send-email','MailController@postsendmail')->name('admin.sendmail');
	Route::get('addmember','UserController@getaddmember')->name('admin.addmember');
	Route::post('addmember','UserController@postaddmember')->name('admin.addmember');
});
