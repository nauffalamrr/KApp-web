<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\DriverController;
use App\Http\Controllers\Web\WebTaskController;

Route::get('/', [\App\Http\Controllers\Web\AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [\App\Http\Controllers\Web\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\Web\AuthController::class, 'login']);
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/drivers', [DriverController::class, 'index']);
    Route::post('/drivers/store', [DriverController::class, 'store']);
    Route::put('/drivers/update/{id}', [DriverController::class, 'update']);
    Route::delete('/drivers/delete/{id}', [DriverController::class, 'destroy']);

    Route::get('/tasks', [WebTaskController::class, 'index']);
    Route::post('/tasks/assign', [WebTaskController::class, 'assignTask']);
    Route::get('/history', [WebTaskController::class, 'history']);
});