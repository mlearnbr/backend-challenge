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

Route::get('/', function () {
    return redirect(route('users.index'));
});

Route::get('users/datatable', 'DashboardController@datatable')
    ->name('users.datatable');
Route::resource('users', 'DashboardController');
Route::put('users/{user}/upgrade', 'DashboardController@upgrade')
    ->name('users.upgrade');
Route::put('users/{user}/downgrade', 'DashboardController@downgrade')
    ->name('users.downgrade');
