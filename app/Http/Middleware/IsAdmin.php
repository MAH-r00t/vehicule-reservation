<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Check if the user is logged in, and if their database 'type' is 'admin'
        if ($request->user() && $request->user()->type === 'admin') {
            return $next($request); // Passed! Allow them to proceed to the admin action
        }

        // 2. If they are a client, block them immediately with a 403 Forbidden
        return response()->json([
            'status' => 'error',
            'message' => 'Access Denied. Management privileges required.'
        ], 403);
    }
}
