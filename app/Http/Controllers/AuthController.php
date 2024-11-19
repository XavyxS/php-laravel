<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
  public function loginForm()
  {
    return view('loginForm');
  }

  public function loginusr(Request $request)
  {
    $email = $request->input('email');
    $password = $request->input('password');
    try {
      // Validar los datos del formulario con mensajes personalizados
      $validatedData = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
      ], [
        'email.required' => 'El campo email es obligatorio.',
        'email.email' => 'El campo correo debe ser un email válido.',
        'password.required' => 'El password es obligatorio.',
      ]);

      // Si la validación pasa, continúa con el Inicio de Sesión...


      // Comprobar si el email está registrado
      $user = User::where('email', $request->input('email'))->first();

      if (!$user) {
        // Si el usuario no existe, devolver un mensaje de error
        return redirect()->back()->with('errores', [
          'email' => ['El email no está registrado.']
        ]);
      }

      // Comprobar si la contraseña es correcta
      if (!Hash::check($request->input('password'), $user->password)) {
        // Si la contraseña es incorrecta, devolver un mensaje de error
        return redirect()->back()->with('errores', [
          'password' => ['La contraseña es incorrecta.']
        ]);
      }

      // Si todo es correcto, iniciamos Sesión
      Auth::login($user);

      $cookie = cookie('user_id', $user->id, 43200); // 43200 minutos = 30 días

      // Guardar el nombre del usuario en la sesión
      session(['name' => $user->name]);

      // Redirigir al usuario a la página deseada
      return redirect('/dashboard')->withCookie($cookie); 


    } catch (ValidationException $e) {
      // Capturar los errores de validación
      $validationErrors = $e->errors();
      // Devolver la vista 'registroForm' con el array de errores y los valores de 'name' y 'email'
      return redirect()->back()
        ->withInput() // Esto preserva los valores de los campos en el formulario
        ->with('errores', $validationErrors);
    }
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
        'password' => $password, // Se hashea automáticamente. Se configuró en Models
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

  public function logout()
  {
    // Cerrar la sesión del usuario
    Auth::logout();

    // Limpiar toda la sesión
    Session::flush();

    // Borrar la cookie 'user_id'
    $cookie = Cookie::forget('user_id');

    // Redirigir al usuario a la página de inicio con la cookie borrada
    return redirect('/')->withCookie($cookie);
  }
}
