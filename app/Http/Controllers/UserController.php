<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function mensaje()
    {
        // Lógica de negocio
        return view('mensaje');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
