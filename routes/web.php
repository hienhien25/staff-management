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
Route::get('PositionList','PositionController@showlist')->name('PositionList');
Route::get('StaffList/{id}.html','PositionController@showstafflist')->name('Position.StaffList');
Route::get('addPosition','PositionController@getadd')->name('addPosition');
Route::post('addPosition','PositionController@postadd')->name('addPosition');
Route::get('UserList','UserController@showlist')->name('UserList');
Route::get('addStaff','UserController@getadd')->name('user.addstaff');
Route::post('addStaff','UserController@postadd')->name('user.addstaff');
Route::get('editStaff/{id}.html','UserController@getedit')->name('user.editStaff');
Route::post('editStaff/{id}.html','UserController@edit')->name('user.editStaff');
