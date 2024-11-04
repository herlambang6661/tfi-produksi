<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    // public function __invoke(Request $request)
    // {
    //     //set validation
    //     $validator = Validator::make($request->all(), [
    //         'username' => 'required',
    //         'password' => 'required',
    //     ]);

    //     // if validation fails
    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }

    //     // get credentials from request
    //     $credentials = $request->only('username', 'password');
    // }

    public function authenticate(Request $request): JsonResponse
    {
        // Validasi input KTP dan password
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->errors(),
            ], 422);
        }

        // Coba autentikasi pengguna dengan username dan password
        if (Auth::attempt($request->only('username', 'password'))) {
            $user = Auth::user();

            // Membuat token JWT dari pengguna yang terautentikasi
            try {
                $token = JWTAuth::fromUser($user);
            } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                return response()->json([
                    "status" => false,
                    "errors" => "Could not create token",
                ], 500);
            }

            // Mengembalikan respon dengan token JWT
            return response()->json([
                "status" => true,
                "token" => $token,
                "user" => $user, // Optional: mengembalikan informasi user
            ], 200);
        } else {
            // Jika kredensial salah
            return response()->json([
                "status" => false,
                "header" => "Invalid credentials",
                "errors" => ["Cek Username & Password Anda"],
            ], 401);
        }
    }
    public function getUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'User not found'], 404);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Invalid token'], 400);
        }

        return response()->json(compact('user'));
    }

    // User logout
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Successfully logged out']);
    }
}
