<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SppdController;
use App\Http\Controllers\Api\EmployeController;

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
Route::middleware('auth:sanctum')->prefix('sppd')->group(function(){
    Route::get('/', [SppdController::class, 'index']);
    Route::post('/', [SppdController::class, 'add']);
    Route::put('/{id}', [SppdController::class, 'update']);
    Route::delete('/{id}', [SppdController::class, 'delete']);
    Route::post('/participant', [SppdController::class, 'participant_add']);
    Route::put('/participant/{id}', [SppdController::class, 'participant_update']);
    Route::delete('/participant/{id}', [SppdController::class, 'participant_delete']);
});

Route::middleware('auth:sanctum')->prefix('employe')->group(function(){
    Route::get('/', [EmployeController::class, 'index']);
    Route::post('/', [EmployeController::class, 'create']);
    Route::put('/{id}', [EmployeController::class, 'update']);
    Route::delete('/{id}', [EmployeController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
