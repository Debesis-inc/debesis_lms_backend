<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;


// Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Route::post('/auth/login', [AuthController::class, 'login']);
//protected route
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/register', [AuthController::class, 'register']);
});