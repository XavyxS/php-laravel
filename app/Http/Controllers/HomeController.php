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
    // Verificar si existe la cookie 'user_id'
    $userId = Cookie::get('user_id');

    if ($userId) {
      // Buscar al usuario por ID
      $user = User::find($userId);
      echo "<script>console.log('Si hay Userid');</script>";


      if ($user) {
        // Iniciar sesión al usuario
        Auth::login($user);
        // Redirigir al dashboard con un script de JavaScript para la consola
        echo "<script>console.log('Autenticación exitosa para el usuario: {$user->name}');</script>";



        // Redirigir al dashboard
        return redirect('/dashboard');
      }
    }

    // Si no hay cookie o el usuario no se encuentra, mostrar la página de inicio
    echo "<script>console.log('No hubo Autenticacion:');</script>";

    return view('welcome');
  }
}
