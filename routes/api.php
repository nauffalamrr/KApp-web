<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RouteController;

Route::get('/tes', function () {
    return response()->json(['message' => 'API route works']);
});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/task', [TaskController::class, 'index']);
    Route::get('/task/{id}', [TaskController::class, 'show']);
    Route::post('/task/{id}/accept', [TaskController::class, 'accept']);
    Route::post('/task/{id}/complete', [TaskController::class, 'complete']);
    Route::post('/task/{task_id}/update-destination', [TaskController::class, 'updateDestination']);
    Route::get('/history', [TaskController::class, 'history']);
    Route::get('/history/{id}', [TaskController::class, 'detail']);
    Route::post('/route', [RouteController::class, 'calculate']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
