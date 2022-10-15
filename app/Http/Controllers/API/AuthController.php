<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // API untuk autentikasi login
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ],401);
        }
        $user->tokens()->delete(); // hapus token lama di database kalau ada
        $token = $user->createToken($request->device_name)->plainTextToken; // repleace dgn token baru kombinasi antara device_name dan user-nya

        return response()->json([
            'success' => true,
            'message' => 'success',
            'user' => $user,
            'token' => $token
        ],200);
    }
}
