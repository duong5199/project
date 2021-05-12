<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



// Form danh sách tài khoản người dùng

//Route::get('/', 'LayoutController@index')->name('home');

Auth::routes();

//// Authentication Routes...
//Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('login', 'Auth\LoginController@login');
//Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function () {

    // Dashboard
    Route::get('/', 'DashboardController@index')->name('home');

    // User
    Route::resource('users', 'UserController');
    Route::post('users/list', 'UserController@list')->name('users.list');
    Route::post('users/deletes', 'UserController@deletes')->name('users.deletes');

    // Employee
    Route::resource('employees', 'EmployeeController');
    Route::post('employees/list', 'EmployeeController@list')->name('employees.list');
    Route::post('employees/deletes', 'EmployeeController@deletes')->name('employees.deletes');

    // Document
    Route::post('document/upload-files', 'DocumentController@files')->name('document.upload-files');
    Route::post('document/delete-files', 'DocumentController@deleteFiles')->name('document.delete-files');
    Route::get('document/get-files/{id}', 'DocumentController@getFiles')->name('document.get-files');

    // Department
    Route::get('departments/select2', 'DepartmentController@load')->name('departments.select2');
    Route::resource('departments', 'DepartmentController');
    Route::post('departments/list', 'DepartmentController@list')->name('departments.list');
    Route::post('departments/deletes', 'DepartmentController@deletes')->name('departments.deletes');

    // Position
    Route::get('positions/select2', 'PositionController@load')->name('positions.select2');
    Route::resource('positions', 'PositionController');
    Route::post('positions/list', 'PositionController@list')->name('positions.list');
    Route::post('positions/deletes', 'PositionController@deletes')->name('positions.deletes');

    // Payroll
    Route::post('payrolls/render', 'PayrollController@render')->name('payrolls.render');
    Route::get('payrolls/detail/{id}', 'PayrollController@detail')->name('payrolls.detail');
    Route::get('payrolls/send-mail/{id}', 'PayrollController@sendMail')->name('payrolls.send-mail');
    Route::post('payrolls/send-mail-multi', 'PayrollController@sendMailMulti')->name('payrolls.send-mail-multi');
    Route::resource('payrolls', 'PayrollController');
    Route::post('payrolls/list', 'PayrollController@list')->name('payrolls.list');
    Route::post('payrolls/deletes', 'PayrollController@deletes')->name('payrolls.deletes');


});
