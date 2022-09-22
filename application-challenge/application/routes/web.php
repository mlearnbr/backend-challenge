<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'UsersController@index');
Route::get('users', 'UsersController@index')->name('users.index');
Route::get('users/create', 'UsersController@create')->name('users.create');
Route::post('users', 'UsersController@store')->name('users.store');
Route::put('users/{id}/upgrade', 'UsersController@upgrade')->name('users.upgrade');
Route::put('users/{id}/downgrade', 'UsersController@downgrade')->name('users.downgrade');

