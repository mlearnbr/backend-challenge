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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@diagonalsDiff');
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', 'UsersController@index')->name('home');
    Route::get('/upgrade/{id}', 'UsersController@upgrade')->name('upgrade');
    Route::get('/downgrade/{id}', 'UsersController@downgrade')->name('downgrade');
    Route::get('/delete/{id}', 'UsersController@delete')->name('delete');
});
