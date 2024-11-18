<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
  public function loginForm()
  {
    return view('loginForm');
  }

  public function registroForm()
  {
    return view('registroForm');
  }

  public function registro(Request $request)
  {
    $name = $request->input('name');;
    $email = $request->input('email');
    $password = $request->input('password');

    try {
      // Validar los datos del formulario con mensajes personalizados
      $validatedData = $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
      ], [
        'name.required' => 'El nombre es obligatorio.',
        'name.max' => 'El nombre no debe ser mayor de 100 caracteres.',
        'email.required' => 'El campo email es obligatorio.',
        'email.email' => 'El campo correo debe ser un email válido.',
        'email.unique' => 'El email ya está registrado.',
        'password.required' => 'El password es obligatorio.',
        'password.min' => 'El password debe tener al menos 8 caracteres.',
      ]);

      // Si la validación pasa, continúa con el registro...
      // Crear y guardar el usuario en la base de datos
      $user = User::create([
        'name' => $name,
        'email' => $email,
        'password' => $password, // Se hashea automáticamente
      ]);

      // Redirigir al usuario con un mensaje de éxito
      return redirect('/mensaje');

    } catch (ValidationException $e) {
      // Capturar los errores de validación
      $validationErrors = $e->errors();
      // Devolver la vista 'registroForm' con el array de errores y los valores de 'name' y 'email'
      return redirect()->back()
        ->withInput() // Esto preserva los valores de los campos en el formulario
        ->with('errores', $validationErrors);
    }
  }
}
