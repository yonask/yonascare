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

Route::get('/', function () {
    return view('welcome');
});

//..................google socalize.....................................//

Route::get('login/google', 'Auth\LoginController@redirectToProvider')->name('login.google');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//....................Admin Route ..........................//

Route::GET('admin','Admin\LoginController@showLoginForm')->name('admin.login');
Route::POST('admin', 'Admin\LoginController@login');
Route::POST('admin-password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::GET('admin-password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::POST('admin-password/reset', 'Admin\ResetPasswordController@reset');
Route::GET('admin-password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

//...............................Admin  ..................//
Route::GET('admin/home', 'AdminController@index');




//........................ sub Admin admin ......................//
Route::GET('admin/companyadmin', 'CompanyAdminController@index');
Route::GET('admin/test', 'CompanyAdminController@test');
Route::GET('admin/test2', 'CompanyAdminController@test2');
Route::GET('admin/test3', 'AdminController@test3');

//..................... Super Admin........................//

Route::GET('superadmin','SuperAdmin\LoginController@showLoginForm')->name('superadmin.login');
Route::POST('superadmin', 'SuperAdmin\LoginController@login');
Route::POST('superadmin-password/email','SuperAdmin\ForgotPasswordController@sendResetLinkEmail')->name('superadmin.password.email');
Route::GET('superadmin-password/reset', 'SuperAdmin\ForgotPasswordController@showLinkRequestForm')->name('superadmin.password.request');
Route::POST('superadmin-password/reset', 'SuperAdmin\ResetPasswordController@reset');
Route::GET('superadmin-password/reset/{token}', 'SuperAdmin\ResetPasswordController@showResetForm')->name('superadmin.password.reset');


//..................................Super Admin function ..................//
Route::GET('/superadmin/home', 'SuperAdminController@index');

    //...................Company ........................//
Route::get('/superadmin/company', 'CompanyController@index')->name('company.display');
Route::get('/superadmin/company/create', 'CompanyController@create')->name('superadmin.company');
Route::post('/superadmin/company', 'CompanyController@store')->name('superadmin.company.register');
Route::get('/superadmin/company/{id}/edit', 'CompanyController@edit');
Route::put('/superadmin/company/{id}', 'CompanyController@update');
Route::delete('/superadmin/company/{id}', 'CompanyController@destroy');
   //.................. Company end ...............//

//....................Email Domain ............................//
Route::get('/superadmin/emaildomain', 'CompanyEmailDomainController@index')->name('emaildomain.dis');
Route::get('/superadmin/emaildomain/create', 'CompanyEmailDomainController@create');
Route::post('/superadmin/emaildomain', 'CompanyEmailDomainController@store');
Route::get('/superadmin/emaildomain/{id}/edit', 'CompanyEmailDomainController@edit');
Route::put('/superadmin/emaildomain/{id}', 'CompanyEmailDomainController@update');
Route::delete('/superadmin/emaildomain/{id}','CompanyEmailDomainController@destroy');
//................... Email Domain End ......................//


//....................Administrators created by super admin............................//
Route::get('/superadmin/administrators', 'AdministratorsCreatedbySuperAdmin@index');
Route::get('/superadmin/administrators/create', 'AdministratorsCreatedbySuperAdmin@create');
Route::post('/superadmin/administrators', 'AdministratorsCreatedbySuperAdmin@store');
Route::get('/superadmin/administrators/{id}/edit', 'AdministratorsCreatedbySuperAdmin@edit');
Route::put('/superadmin/administrators/{id}', 'AdministratorsCreatedbySuperAdmin@update');
Route::delete('/superadmin/administrators/{id}','AdministratorsCreatedbySuperAdmin@destroy');

//................... Administarators created by super admin End ......................//

//.....................user account ..............................//

Route::get('verifyEmailFirst','Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');
Route::get('verify/{email}/{verifyToken}','Auth\RegisterController@sendEmailDone')->name('sendEmailDone');



//.....................user account.....................//