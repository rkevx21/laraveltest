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
    // return view('img');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/dashboard', 'DashboardController@index');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/profile/{id}/edit', 'ProfileController@edit')->name('profile.edit');
Route::put('/profile/{id}/update','ProfileController@update')->name('profile.update');
Route::put('/logout','Auth\LoginController@profileLogout')->name('profile.logout');

Route::prefix('admin')->group(function() {
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
	Route::get('/profile/{id}/edit', 'AdminProfileController@edit')->name('admin.profile.edit');
	Route::put('/profile/{id}/update','AdminProfileController@update')->name('admin.profile.update');
	Route::delete('/profile/{id}/delete','AdminProfileController@destroy')->name('admin.profile.delete');
	Route::get('/', 'AdminDashboardController@index')->name('admin.dashboard');
});

// Route::post('/upload', 'ImageController@upload')->name('upload');
// Route::post('/upload', 'Auth\RegisterController@uploadImage')->name('uploadImage');