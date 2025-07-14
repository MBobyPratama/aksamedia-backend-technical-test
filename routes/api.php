<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Middleware\RedirectIfAuthenticated;

// Tugas 1: Login API - only accessible when not authenticated
Route::post('/login', [AuthController::class, 'login'])
    ->middleware([RedirectIfAuthenticated::class . ':admin']);

// Protected routes - require authentication
Route::middleware('auth:admin')->group(function () {
    // Tugas 2: Get all divisions
    Route::get('/divisions', [DivisionController::class, 'index']);

    // Tugas 3: Get all employees
    Route::get('/employees', [EmployeeController::class, 'index']);

    // Tugas 4: Create employee
    Route::post('/employees', [EmployeeController::class, 'store']);

    // Tugas 5: Update employee
    Route::put('/employees/{id}', [EmployeeController::class, 'update']);

    // Tugas 6: Delete employee
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);

    // Tugas 7: Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
