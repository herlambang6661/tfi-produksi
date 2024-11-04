<?php

use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('auth', [LoginController::class, 'authenticate']);
Route::get('user', [LoginController::class, 'getUser']);
Route::post('logout', [LoginController::class, 'logout']);
