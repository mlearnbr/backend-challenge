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
    return view('home');
});

Route::get('user/parse_index', 'UserController@parse_index');
Route::get('user/edit', 'UserController@edit');
Route::get('user/delete', 'UserController@delete');
Route::post('user/save', 'UserController@save');
