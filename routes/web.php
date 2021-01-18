<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::resource('users', UserController::class);

Route::put('/users/{user}/upgrade', [UserController::class, 'upgrade'])->name('users.upgrade');
Route::put('/users/{user}/downgrade', [UserController::class, 'downgrade'])->name('users.downgrade');
