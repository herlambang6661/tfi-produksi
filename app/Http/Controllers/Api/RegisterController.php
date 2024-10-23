<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'stb' => 'required|unique:users',
            'nickname' => 'required',
            'username' => 'required',
            'password' => 'required|min:6|confirmed',
            'role' => 'required',
            'telp' => 'required',
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create user
        $user = User::create([
            'stb' => $request->stb,
            'nickname' => $request->nickname,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'telp' => $request->telp,
        ]);

        //return response JSON user is created
        return response()->json([
            'success' => true,
            'message' => 'User berhasil dibuat',
            'data' => $user
        ], 201);

        //return response JSON user failed
        return response()->json([
            'success' => false,
            'message' => 'User gagal dibuat',
            'data' => $validator->errors()
        ], 409);
    }
}
