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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('user/{id}', 'HomeController@profile');
Route::get('user/{id}', 'HomeController@profile');
Route::get('user/{id}/follow', 'HomeController@follow')->name('follow');
Route::get('user/{id}/unfollow', 'HomeController@unfollow')->name('unfollow');

Auth::routes();
Route::post('post','HomeController@store');
Route::get('posts','HomeController@allposts');
Route::get('/home', 'HomeController@index')->name('home');
