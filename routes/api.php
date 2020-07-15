<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('users', 'UserController@index');
Route::post('users', 'UserController@create');
Route::put('users/upgrade/{userId}', 'UserController@upgradeUser');
Route::put('users/downgrade/{userId}', 'UserController@downgradeUser');
