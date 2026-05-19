<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VehicleController;

// 1. Test Route (The "Sup" message)
Route::get('/greeting', function() {
    return response()->json([
        'message' => 'sup fuckers'
    ]);
});

// 2. Your Vehicles API
Route::get('/vehicles', [VehicleController::class, 'index']);

// 3. Protected User Route
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');