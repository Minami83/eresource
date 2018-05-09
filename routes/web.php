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
    return view('webpage.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile');
Route::post('/profile', 'HomeController@change');

Route::get('/pretest', 'CourseController@pretest');
Route::post('/preans', 'CourseController@preAns');
Route::get('/posttest', 'CourseController@posttest');
Route::post('/postans', 'CourseController@postAns')->name('postans');

Route::get('/course/{courseName}', 'CourseController@index')->name('course');
Route::post('/next', 'CourseController@nextPage')->name('changePage');
Route::get('/continue', 'CourseController@continue');

Route::get('/admin', 'AdminController@Index');
Route::post('/admin', 'AdminController@verify');

Route::get('/admin/user/list', 'UserController@index');
Route::get('/admin/user/make', 'UserController@create');
Route::post('/admin/user/make', 'UserController@store');
Route::get('/admin/user/detail/{id}', 'UserController@show');
Route::get('/admin/user/edit/{id}', 'UserController@edit');
Route::post('/admin/user/edit/{id}', 'UserController@update');
Route::delete('/admin/user/delete/{id}', 'UserController@destroy');

Route::get('/admin/jurnal/list', 'JurnalController@index');
Route::get('/admin/jurnal/make', 'JurnalController@create');
Route::post('/admin/jurnal/make', 'JurnalController@store');
Route::get('/admin/jurnal/detail/{id}', 'JurnalController@show');
Route::get('/admin/jurnal/edit/{id}', 'JurnalController@edit');
Route::post('/admin/jurnal/edit/{id}', 'JurnalController@update');
Route::delete('/admin/jurnal/delete/{id}', 'JurnalController@destroy');

Route::get('/admin/test/list', 'TestController@index');
Route::get('/admin/test/make', 'TestController@create');
Route::post('/admin/test/make', 'TestController@store');
Route::get('/admin/test/detail/{id}', 'TestController@show');
Route::get('/admin/test/edit/{id}', 'TestController@edit');
Route::post('/admin/test/edit/{id}', 'TestController@update');
Route::delete('/admin/test/delete/{id}', 'TestController@destroy');
