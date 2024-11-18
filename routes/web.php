<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [HomeController::class, 'index']);
Route::get('/loginForm', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'loginusr']);
Route::get('/registroForm', [AuthController::class, 'registroForm']);
Route::post('/registro', [AuthController::class, 'registro']);
Route::get('/mensaje', [UserController::class, 'mensaje']);
Route::get('/dashboard', [UserController::class, 'dashboard']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/images_list', [ImageController::class, 'imagesList']);
Route::post('/upload_img', [ImageController::class, 'upload_img']);
Route::get('/delete_img/{id}', [ImageController::class, 'delete_img']);
