
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
    return view('auth.login');
});

Route::get('/tes', function () {
    return view('adminlayouts.statistic');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile');
Route::post('/profile', 'HomeController@change');
Route::get('/profile/password', 'HomeController@viewChangePass');
Route::post('/profile/password', 'HomeController@changePass');
Route::get('/error/403', 'HomeController@errorPage');

Route::get('/pretest', 'CourseController@pretest');
Route::post('/preans', 'CourseController@preAns');
Route::get('/posttest', 'CourseController@posttest');
Route::post('/postans', 'CourseController@postAns')->name('postans');
Route::get('/testscore', 'CourseController@testscore');
Route::get('/sertif', 'CourseController@sertifPage');

Route::get('/course/{courseName}', 'CourseController@index')->name('course');
Route::post('/next', 'CourseController@nextPage')->name('changePage');
Route::get('/continue', 'CourseController@continue');

Route::get('/admin', 'AdminController@Index')->middleware('role');
Route::post('/admin', 'AdminController@verify')->middleware('role');
Route::get('/admin/laporan/{year}', 'AdminController@recap')->middleware('role');
Route::get('/admin/logreport', 'AdminController@logReport')->middleware('role');
Route::get('/admin/statistik', 'AdminController@statistik')->middleware('role');

Route::get('/admin/user/list', 'UserController@index')->middleware('role');
Route::get('/admin/user/make', 'UserController@create')->middleware('role');
Route::post('/admin/user/make', 'UserController@store')->middleware('role');
Route::get('/admin/user/detail/{id}', 'UserController@show')->middleware('role');
Route::get('/admin/user/score/{id}', 'UserController@showTest')->middleware('role');
Route::get('/admin/user/edit/{id}', 'UserController@edit')->middleware('role');
Route::post('/admin/user/edit/{id}', 'UserController@update')->middleware('role');
Route::post('/admin/user/edit/jurnal/{id}', 'UserController@updateJurnal')->middleware('role');
Route::delete('/admin/user/delete/{id}', 'UserController@destroy')->middleware('role');

Route::get('/admin/jurnal/list', 'JurnalController@index')->middleware('role');
Route::get('/admin/jurnal/make', 'JurnalController@create')->middleware('role');
Route::post('/admin/jurnal/make', 'JurnalController@store')->middleware('role');
Route::get('/admin/jurnal/detail/{id}', 'JurnalController@show')->middleware('role');
Route::get('/admin/jurnal/edit/{id}', 'JurnalController@edit')->middleware('role');
Route::post('/admin/jurnal/edit/{id}', 'JurnalController@update')->middleware('role');
Route::delete('/admin/jurnal/delete/{id}', 'JurnalController@destroy')->middleware('role');

Route::get('/admin/test/list', 'TestController@index')->middleware('role');
Route::get('/admin/test/make', 'TestController@create')->middleware('role');
Route::post('/admin/test/make', 'TestController@store')->middleware('role');
Route::get('/admin/test/detail/{id}', 'TestController@show')->middleware('role');
Route::get('/admin/test/edit/{id}', 'TestController@edit')->middleware('role');
Route::post('/admin/test/edit/{id}', 'TestController@update')->middleware('role');
Route::delete('/admin/test/delete/{id}', 'TestController@destroy')->middleware('role');
