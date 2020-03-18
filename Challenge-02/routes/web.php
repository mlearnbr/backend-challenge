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

Route::get('/',                 'AppController@appIndex');

Route::prefix('/user')->group(function () {
    Route::post('/',            'UserController@createUser');
    Route::get('/',             'UserController@listUsers');
    Route::put('/upgrade',      'UserController@upgradeUser');
    Route::put('/downgrade',    'UserController@downgradeUser');
});
