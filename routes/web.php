<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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

Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users/new', 'new');
    Route::post('/users/create', 'create');
    Route::post('/users/upgrade', 'upgrade');
    Route::post('/users/downgrade', 'downgrade');
});
