<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()
            ]);
        } else {
            $rememberMe = $request->remember ? true : false;
            $up = $request->only(["username", "password"]);
            if (Auth::attempt($up, $rememberMe)) {
                return response()->json([
                    "status" => true,
                    "redirect" => url("dashboard")
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "header" => "Invalid credentials",
                    "errors" => ["Cek Username & Password Anda"],
                ]);
            }
        }
    }


    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('/');
    }
}
