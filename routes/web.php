<?php

use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/users');

Route::get('/users/{user}/toggle_access', 'UserController@toggleAccessLevel')->name('users.toggle_access');

Route::resource('users', 'UserController')->except([
    'edit', 'update', 'show', 'destroy'
]);
