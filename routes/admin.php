<?php
/*
|--------------------------------------------------------------------------
| Web Routes for admin type
|--------------------------------------------------------------------------
|
 */
Route::get('dashboard', 'Admin\AdminController@index')->name('admin.dashboard');
Route::get('store', 'Admin\AdminController@store')->name('admin.store');