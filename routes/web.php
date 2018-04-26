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
    return view('adminlayouts.statistic');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/next', 'CourseController@nextPage')->name('changePage');
Route::get('/course/{courseName}', 'CourseController@index')->name('course');
Route::get('/admin', 'HomeController@adminIndex');
