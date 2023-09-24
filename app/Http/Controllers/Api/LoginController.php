<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * Get Authenticated User
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        if (Auth::check()) {
            $auth = Auth::user();
            return response()->json([
                'id' => $auth->id,
                'email' => $auth->email,
                'name' => $auth->name,
            ]);
        }

        return response()->json(['massage' => 'Unauthanticated User'], 401);
    }
    /**
     * Get user logged in via email and password
     * 
     * @return JsonResponse
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->json([
            'massage' => 'Logged in ..!',
            'data' => Auth::user()
        ]);
    }

    /**
     * Logout user session
     * 
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['massage' => 'Logout Success..!']);
    }
}
