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
    return view('auth/login');
});

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::group(['prefix' => 'users'], function () {
        Route::get('/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        Route::post('/', [\App\Http\Controllers\UserController::class, 'store'])
            ->name('users.store')
            ->middleware('store.user.validation');
    });
});
