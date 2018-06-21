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

// Allow GET requests to log out. By default, only POST requests are enabled

Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

Auth::routes();

Route::get('schools', 'SchoolController@index')->name('schools');
Route::get('schools/{school}', 'SchoolController@showSchool')->name('schools.show');

Route::get('users', 'UserController@index')->name('users');
Route::get('users/{user}', 'UserController@show')->name('users.show');

Route::get('/', 'HomeController@index')->name('home');

Route::post('language', 'LanguageController@changeLanguage')->name('language');