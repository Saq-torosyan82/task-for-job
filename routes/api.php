<?php

use App\Http\Controllers\SportController;
use App\Http\Controllers\StudentController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/students', [StudentController::class, 'index']);
Route::get('/sports', [SportController::class, 'index']);

Route::group(['middleware'=>'XSS'], function() {
    //Students
    Route::prefix('/student')->group(function () {
        Route::post('/', [StudentController::class, 'store']);
        Route::put('/{id}', [StudentController::class, 'update']);
        Route::delete('/{id}', [StudentController::class, 'destroy']);
    });

    //Sports
    Route::prefix('/sport')->group(function () {
        Route::post('/', [SportController::class, 'store']);
        Route::put('/{id}', [SportController::class, 'update']);
        Route::delete('/{id}', [SportController::class, 'destroy']);
    });
});
