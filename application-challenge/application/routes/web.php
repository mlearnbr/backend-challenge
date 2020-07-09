<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'UsersController@index');
Route::resource('users', 'UsersController');
