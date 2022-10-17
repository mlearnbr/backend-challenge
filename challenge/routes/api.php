<?php

use App\Http\Controllers\Aplication\AllUsersContoller;
use App\Http\Controllers\Aplication\DowngradeUsersContoller;
use App\Http\Controllers\Aplication\StoreUserController;
use App\Http\Controllers\Aplication\UpgradeUsersContoller;
use App\Http\Controllers\ChallengeLogicalController;
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

Route::get('/challenge-logical', ChallengeLogicalController::class);

Route::post('/user', StoreUserController::class);
Route::get('/user', AllUsersContoller::class);
Route::put('/user/{id}/upgrade', UpgradeUsersContoller::class);
Route::put('/user/{id}/downgrade', DowngradeUsersContoller::class);