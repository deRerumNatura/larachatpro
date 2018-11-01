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

Route::get('choose/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('dashboard', 'UserController@index')->name('user.dashboard')->middleware('auth');

Route::get('login', 'Auth\AuthenticationController@showLoginForm')->name('login');
Route::post('login', 'Auth\AuthenticationController@login');
Route::post('logout', 'Auth\AuthenticationController@logout')->name('logout');

Route::get('register', 'Auth\AuthenticationController@showLoginForm')->name('register');
Route::post('register', 'Auth\AuthenticationController@login');

Route::resource('messages', 'MessagesController', ['only' => [
    'index', 'store'
]])->middleware('chat');

