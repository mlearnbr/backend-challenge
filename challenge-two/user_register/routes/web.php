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

Route::get('/', function(){
    return redirect()->route('users.index');
});

Route::prefix('usuarios')->group(function(){
    Route::view('/', 'users.index')->name('users.index');
    Route::view('/cadastrar', 'users.register')->name('users.register');
});
