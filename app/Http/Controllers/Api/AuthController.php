<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Register new user
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100|unique:tbl_users,username',
            'email' => 'required|email|unique:tbl_users,email',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'nullable|exists:tbl_roles,role_id' // optional, default 3
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id ?? 3, // default student
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ], 201);
    }

    // Login user
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    // Logout user
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    // Get authenticated user
    public function user(Request $request)
    {
        $user = $request->user()->load('role', 'profile');
        return response()->json(['user' => $user]);
    }

    // Refresh token
    public function refresh(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete(); // delete old tokens

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Token refreshed successfully',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function index()
    {
        $users = User::with('role')->get();

        return response()->json([
            'message' => 'All registered users',
            'data' => $users
        ]);
    }

}
