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
Auth::routes(['verify' => true]);

// Login and logout
Route::get('admin-login', 'PageController@getLogin')->name('adminLogin');
Route::post('admin-login', 'PageController@postLogin')->name('adminLogin');
Route::get('logout', 'PageController@logout')->name('logout');
Route::get('update-profile/{token}.html', 'ProfileController@getUpdate')->name('admin.updateProfile');
Route::post('update-profile', 'ProfileController@postUpdate')->name('admin.updateProfile');
Route::group(['prefix'=>'password'], function () {
    Route::post('create-password', 'PasswordController@create')->name('password.createPassword');
    Route::get('reset-password/{token}.html', 'PasswordController@getReset')->name('password.resetPassword');
    Route::post('reset-password', 'PasswordController@postResset')->name('password.resetPassword');
});
Route::get('forgot-password', 'PasswordController@getForgot')->name('forgotPassword');
//Account authentication
//Route::get('confirm-email/{token}.html','PasswordController@getConfirm')->name('confirmEmail');
Route::post('confirm-email', 'PasswordController@postConfirm')->name('confirmEmail');
Route::get('active', 'PasswordController@getActive')->name('active');
Route::get('send-mail-to-active', 'PasswordController@getMailToActive')->name('sendMailToActive');
Route::get('verification/{token}.html', 'PasswordController@verification')->name('verification');
Route::get('active-suscess', 'PasswordController@getSuscess')->name('activeSuscess');
Route::get('expiration', 'PasswordController@getExpire')->name('expiration');
Route::group(['prefix'=>'admin','middleware'=>['admin_login']], function () {
    //Home
    Route::get('/', 'PageController@index')->name('home');
    //Department
    Route::get('department-list', 'DepartmentController@showList')->name('admin.departmentList');
    Route::get('add-department', 'DepartmentController@getAdd')->name('admin.addDepartment');
    Route::post('add-department', 'DepartmentController@postAdd')->name('admin.addDepartment');
    Route::post('delete-department', 'DepartmentController@postDelete')->name('admin.deleteDepartment');
    Route::post('edit-department/{id}.html', 'DepartmentController@postEdit')->name('admin.editDepartment');
    Route::get('export-department-list-to-excel', 'DepartmentController@export')->name('exportDepartment');
    //Position
    Route::get('position-list/{id}.html', 'DepartmentController@showListPosition')->name('admin.positionList');
    Route::get('staff-list/{id}.html', 'PositionController@showStaffList')->name('admin.position.staffList');
    Route::get('add-position', 'PositionController@getAdd')->name('admin.addPosition');
    Route::post('add-position', 'PositionController@postAdd')->name('admin.addPosition');
    Route::post('edit-position', 'PositionController@postEdit')->name('admin.editPosition');
    Route::post('delete-position/{id}.html', 'PositionController@postDelete')->name('admin.deletePosition');
    Route::get('get-edit-position/{id}','PositionController@getEditPosition')->name('admin.editPosition');
    //User
    Route::get('user-list', 'UserController@showList')->name('admin.userList');
    Route::get('add-staff', 'UserController@getAdd')->name('admin.user.addStaff');
    Route::post('add-staff', 'UserController@postAdd')->name('admin.user.addStaff');
    Route::get('edit-staff/{id}.html', 'UserController@getEdit')->name('admin.user.editStaff');
    Route::post('post-edit-staff/{id}.html', 'UserController@postEdit')->name('admin.user.editStaff');
    Route::post('delete-staff', 'UserController@postDelete')->name('admin.user.deleteStaff');
    Route::post('change-uright','UserController@changeUright')->name('admin.user.changeUright');
    Route::get('search-statist','UserController@getSearchStatistic')->name('admin.user.searchStatisticPersonal');
    //Ajax
    Route::get('ajax-department/{iddepartment}', 'AjaxController@getDepartment')->name('admin.ajaxDepartment');
    //Profile
    Route::get('profile/{id}.html', 'UserController@getProfile')->name('profile');
    Route::post('profile/{id}.html', 'UserController@postEditProfile')->name('profile');
    Route::post('update-contact-information/{id}.html','ProfileController@postUpdateInformation')->name('admin.updateContactInformation');
    //Checkin
    Route::get('checkin', 'CheckinController@getCheckin')->name('admin.checkin');
    Route::post('post-checkin', 'CheckinController@postCheckin')->name('admin.checkin');
    Route::get('show-checkin-list', 'CheckinController@showList')->name('admin.showCheckinList');
    Route::post('show-checkin-list', 'CheckinController@postShow')->name('admin.showCheckinList');
    //Checkout
    Route::get('checkout', 'CheckoutController@getCheckout')->name('admin.checkout');
    Route::post('post-checkout', 'CheckoutController@postCheckout')->name('admin.postcheckout');
    Route::get('edit-checkout/{id}.html', 'CheckinController@getEditCheckout')->name('admin.editCheckout');
    Route::post('edit-checkout/{id}.html', 'CheckinController@postEditCheckout')->name('admin.editCheckout');
    Route::post('delete-checkin/{id}.html', 'CheckinController@getDelete')->name('admin.deleteCheckin');
    //Mail
    Route::get('send-email', 'MailController@getSendMail')->name('admin.sendMail');
    Route::post('send-email', 'MailController@postSendMail')->name('admin.sendMail');
    Route::get('mailbox', 'MailController@getMailbox')->name('admin.mailbox');
    Route::get('search-mail-box','MailController@getSearchMail')->name('admin.searchMail');
    Route::get('mail-received','MailController@getMailReceived')->name('admin.mailReceived');
    //Regisster account by admin
    Route::get('add-member', 'UserController@getAddMember')->name('admin.addMember');
    Route::post('add-member', 'UserController@postAddMember')->name('admin.addMember');
    //Log
    Route::get('log', 'LogController@getLog')->name('admin.log');
    Route::get('time-log', 'LogController@getTimeLog')->name('admin.timeLog');
    //Route::get('add-item/{id}','LogController@addItem')->name('admin.addItem');
    Route::delete('destroy-log/{id}', 'LogController@destroy')->name('admin.destroyLog');
    Route::post('delete-many-time-log', 'LogController@deleteMany')->name('admin.deleteMany');
    Route::post('delete-time-log', 'LogController@deleteTimeLog')->name('admin.deleteTimeLog');
    Route::get('detail-time-log/{id}','LogController@getDetailTimeLog')->name('admin.detailTimeLog');
    Route::get('get-edit-time-log/{id}','LogController@getEditTimeLog')->name('admin.getEditTimeLog');
    Route::post('edit-time-log','LogController@postEditTimeLog')->name('admin.editTimeLog');
    //Statistics total working hours
    Route::get('show-checkout-list-per-month', 'StatisticController@getShowListPerMonth')->name('CheckoutListPerMonth');
    Route::get('search-checkout-per-day', 'StatisticController@getSearch')->name('admin.search');
    Route::get('statistic-list-personal', 'StatisticController@getPersonal')->name('admin.statisticPersonal');
    Route::get('show-statistic-list','StatisticController@getShowStaticticList')->name('admin.showStatistList');
    Route::get('export-statistic-per-month', 'StatisticController@getExport')->name('admin.exportDataStatistic');
    Route::get('export-statistic-personal','StatisticController@getExportPersonal');
    Route::get('statistics-month-list','StatisticController@getMonth')->name('admin.monthList');
    Route::get('statistics-date-list/{id_month}/{month}.html','StatisticController@getDate')->name('admin.dateList');
    Route::get('statistics-timelog-per-day-list/{date}','StatisticController@getTimeLogPerDay')->name('admin.timeLogPerDay');
    Route::get('search-statistic-each-month/{id_month}.html','StatisticController@getStatisticEachMonth')->name('admin.statisticEachMonth');
});
