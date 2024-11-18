<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function mensaje()
    {
        return view('mensaje');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
