<?php
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

// Public login/register endpoints
Route::post('/login', [AuthController::class, 'login']);

// Protected Group (User must be logged in)
Route::middleware('auth:sanctum')->group(function () {

    // 1. CLIENT ENDPOINTS (Clients can view available cars here)
    Route::get('/vehicles', function () {
        return response()->json(['message' => 'Client view: Listing all available vehicles.']);
    });

    // 2. ADMIN-ONLY ENDPOINTS (Guarded by your new middleware)
    Route::middleware('admin')->group(function () {
        
        // Only an admin can hit this to add a car
        Route::post('/vehicles', function () {
            return response()->json(['message' => 'Admin view: Vehicle added successfully.']);
        });

        // Only an admin can hit this to create another admin account
        Route::post('/admin/create', function () {
            return response()->json(['message' => 'Admin view: New administrator created.']);
        });
    });

});
