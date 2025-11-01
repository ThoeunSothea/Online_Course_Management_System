<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * @param Request $request
     * @param Closure $next
     * @param string $roles  (comma-separated roles: 'admin,lecturer')
     * @return Response
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        // 1️⃣ Check if user is authenticated
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        // 2️⃣ Get user's role name
        $userRole = $request->user()->role->name;

        // 3️⃣ Convert roles string to array
        $allowedRoles = array_map('trim', explode(',', $roles));

        // 4️⃣ Check if user role is in allowed roles
        if (!in_array($userRole, $allowedRoles)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // 5️⃣ Continue request
        return $next($request);
    }
}
