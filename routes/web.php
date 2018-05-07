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
