<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [HomeController::class, 'index']);
Route::get('/loginForm', [AuthController::class, 'loginForm']);
Route::get('/registroForm', [AuthController::class, 'registroForm']);
Route::post('/registro', [AuthController::class, 'registro']);
Route::get('/mensaje', [UserController::class, 'mensaje']);