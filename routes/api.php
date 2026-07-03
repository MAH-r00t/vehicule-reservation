<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VehicleController;
use Illuminate\Support\Facades\Route;

// Public Endpoints
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/vehicles', [VehicleController::class, 'index']); // Public Catalog View
Route::get('/vehicles/{id}', [VehicleController::class, 'show']); // Vue /details/:id

// Protected Group (User must be logged in)
Route::middleware('auth:sanctum')->group(function () {

    // Admin-Only Operations (Vue Dashboard Management)
    Route::middleware('admin')->group(function () {
        Route::post('/vehicles', [VehicleController::class, 'store']);
        Route::put('/vehicles/{id}', [VehicleController::class, 'update']);
        Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy']);
        
        Route::post('/admin/create', function () {
            return response()->json(['message' => 'Admin view: New administrator created.']);
        });
    });
});
