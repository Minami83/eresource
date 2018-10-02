
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
// Route::get('/', function () {
// 	if(Auth::check())
//     	return redirect('/home');
//     else
//     	return view('auth.login');
// });

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/profile', 'HomeController@profile')->middleware('auth');
Route::post('/profile', 'HomeController@change')->middleware('auth');
Route::get('/profile/password', 'HomeController@viewChangePass')->middleware('auth');
Route::post('/profile/password', 'HomeController@changePass')->middleware('auth');
Route::get('/error/403', 'HomeController@errorPage')->middleware('auth');

Route::get('/pretest', 'CourseController@pretest')->middleware('auth');
Route::post('/preans', 'CourseController@preAns')->middleware('auth');
Route::get('/posttest', 'CourseController@posttest')->middleware('auth');
Route::post('/postans', 'CourseController@postAns')->name('postans')->middleware('auth');
Route::get('/testscore', 'CourseController@testscore')->middleware('auth');
Route::get('/sertif', 'CourseController@sertifPage')->middleware('auth');

Route::get('/course/{courseName}', 'CourseController@index')->name('course')->middleware('auth');
Route::post('/next', 'CourseController@nextPage')->name('changePage')->middleware('auth');
Route::get('/continue', 'CourseController@continue')->middleware('auth');

Route::get('/admin', 'AdminController@Index')->middleware('auth')->middleware('role');
Route::post('/admin', 'AdminController@verify')->middleware('auth')->middleware('role');
Route::get('/admin/laporan/{year}', 'AdminController@recap')->middleware('auth')->middleware('role');
Route::get('/admin/logreport', 'AdminController@logReport')->middleware('auth')->middleware('role');
Route::get('/admin/statistik', 'AdminController@statistik')->middleware('auth')->middleware('role');

Route::get('/admin/user/list', 'UserController@index')->middleware('auth')->middleware('role');
Route::get('/admin/user/make', 'UserController@create')->middleware('auth')->middleware('role');
Route::post('/admin/user/make', 'UserController@store')->middleware('auth')->middleware('role');
Route::get('/admin/user/detail/{id}', 'UserController@show')->middleware('auth')->middleware('role');
Route::get('/admin/user/score/{id}', 'UserController@showTest')->middleware('auth')->middleware('role');
Route::get('/admin/user/edit/{id}', 'UserController@edit')->middleware('auth')->middleware('role');
Route::post('/admin/user/edit/{id}', 'UserController@update')->middleware('auth')->middleware('role');
Route::post('/admin/user/edit/jurnal/{id}', 'UserController@updateJurnal')->middleware('auth')->middleware('role');
Route::delete('/admin/user/delete/{id}', 'UserController@destroy')->middleware('auth')->middleware('role');

Route::get('/admin/jurnal/list', 'JurnalController@index')->middleware('auth')->middleware('role');
Route::get('/admin/jurnal/make', 'JurnalController@create')->middleware('auth')->middleware('role');
Route::post('/admin/jurnal/make', 'JurnalController@store')->middleware('auth')->middleware('role');
Route::get('/admin/jurnal/detail/{id}', 'JurnalController@show')->middleware('auth')->middleware('role');
Route::get('/admin/jurnal/edit/{id}', 'JurnalController@edit')->middleware('auth')->middleware('role');
Route::post('/admin/jurnal/edit/{id}', 'JurnalController@update')->middleware('auth')->middleware('role');
Route::delete('/admin/jurnal/delete/{id}', 'JurnalController@destroy')->middleware('auth')->middleware('role');

Route::get('/admin/test/list', 'TestController@index')->middleware('auth')->middleware('role');
Route::get('/admin/test/make', 'TestController@create')->middleware('auth')->middleware('role');
Route::post('/admin/test/make', 'TestController@store')->middleware('auth')->middleware('role');
Route::get('/admin/test/detail/{id}', 'TestController@show')->middleware('auth')->middleware('role');
Route::get('/admin/test/edit/{id}', 'TestController@edit')->middleware('auth')->middleware('role');
Route::post('/admin/test/edit/{id}', 'TestController@update')->middleware('auth')->middleware('role');
Route::delete('/admin/test/delete/{id}', 'TestController@destroy')->middleware('auth')->middleware('role');
