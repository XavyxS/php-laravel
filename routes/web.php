<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [HomeController::class, 'index']);
Route::get('/loginForm', [AuthController::class, 'loginForm']);
Route::get('/registroForm', [AuthController::class, 'registroForm']);