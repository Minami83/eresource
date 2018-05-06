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
Route::get('/tes', function () {
    return view('webpage.register');
});
Route::get('/tes2', function () {
    return view('webpage.login');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/next', 'CourseController@nextPage')->name('changePage');
Route::get('/pretest', 'CourseController@pretest');
Route::post('/pretest', 'CourseController@preAns');
Route::get('/posttest', 'CourseController@posttest');
Route::post('/postest', 'CourseController@postAns');
Route::get('/course/{courseName}', 'CourseController@index')->name('course');
Route::get('/admin', 'AdminController@Index');
Route::post('/admin', 'AdminController@verify');
