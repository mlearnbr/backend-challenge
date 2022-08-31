<?php

use App\Http\Controllers\api\MlearnController;
use App\Http\Controllers\api\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class,'index']);
    Route::get('/show/{id}', [UserController::class,'show']);
    Route::post('/create', [UserController::class,'store']);
    Route::put('/edit', [UserController::class,'update']);
    Route::delete('/delete', [UserController::class,'destroy']);
});

Route::prefix('mlearn')->group(function () {
    Route::put('/upgrade/{id}', [MlearnController::class,'upgradeUser']);
    Route::put('/downgrade/{id}', [MlearnController::class,'downgradeUser']);
});

