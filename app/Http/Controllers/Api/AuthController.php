<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // <-- CRITICAL IMPORT

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validate incoming user input data safely
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        // 2. Locate the user profile inside your database
        $user = User::where('email', $fields['email'])->first();

        // 3. Confirm the account exists and check if the password matches
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bad credentials provided.'
            ], 401);
        }

        // 4. Generate a clean authenticating Token string explicitly
        $token = $user->createToken('auth_token')->plainTextToken;

        // 5. Package up the structural object payload payload response
        return response()->json([
            'status' => 'success',
            'token' => $token,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'type' => $user->type,
            ]
        ], 200);
    }
}
