<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicule; // <-- IMPORTANT IMPORT
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of all available cars (Maps to Vue /main).
     */
    public function index()
    {
        // Fetch only vehicles where availability status is true
        $vehicles = Vehicule::where('is_available', true)->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $vehicles
        ], 200);
    }

      /*Store a newly created vehicle in storage (Only Admins).
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming car data from the admin form
        $fields = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price_per_day' => 'required|integer|min:1',
            'image_url' => 'nullable|string',
        ]);

        // 2. Create the vehicle record
        $vehicle = Vehicule::create([
            'brand' => $fields['brand'],
            'model' => $fields['model'],
            'price_per_day' => $fields['price_per_day'],
            'image_url' => $fields['image_url'] ?? null,
            'is_available' => true, // default to available
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle added to fleet successfully.',
            'data' => $vehicle
        ], 201);
    }

    /**
     * Remove the specified vehicle from storage (Only Admins).
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vehicle not found.'
            ], 404);
        }

        $vehicle->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle removed from fleet successfully.'
        ], 200);
    }

    /**
     * Display a specific car's technical details (Maps to Vue /details/:id).
     */
    public function show(string $id)
    {
        $vehicle = Vehicule::find($id);

        if (!$vehicle) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vehicle not found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $vehicle
        ], 200);
    }
}
