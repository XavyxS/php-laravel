<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use Laravel\Pail\ValueObjects\Origin\Console;

class HomeController extends Controller
{
  public function index()
  {

    if (session('name')) {
      return view('dashboard');
    }

    return view('welcome');
  }
}
