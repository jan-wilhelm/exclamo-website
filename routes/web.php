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
Auth::routes();

Route::middleware('auth')->group(function() {
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );
	Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');

	// PRINCIPLES
	Route::get('users', 'UserController@index')->name('users');
	Route::get('users/{user}', 'UserController@show')->name('users.show');

	// STUDENTS
	Route::get('cases', 'ReportedCaseController@index')->name('incidents');
	Route::get('cases/{case}', 'ReportedCaseController@showIncident')->name('incidents.show');
	Route::get('report', 'ReportedCaseController@report')->name('incidents.report');
	Route::post('create', 'ReportedCaseController@store')->name('incidents.store');

	Route::get('notes', 'NoteController@index')->name('notes');
	Route::match(['post', 'put', 'patch'], 'notes', 'NoteController@update')->name('notes.edit');
});

// HOME
Route::view('/', 'landing_page.index')->name('home');
Route::view('/faq', 'landing_page.faq')->name('faq');

// OTHER
Route::post('language', 'LanguageController@changeLanguage')->name('language');
Route::get('js/lang-{locale}.js', 'LanguageController@getJavascriptLocale')->name('language.js');
Route::view('/impressum', 'layouts.impressum')->name('impressum');
Route::view('/privacy', 'layouts.privacy')->name('privacy_policy');