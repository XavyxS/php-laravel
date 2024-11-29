<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de Sesión</title>
  <link rel="stylesheet" href="css/styles.css">

</head>

<body>
  @include('header')
  <main>
    <div class="conteiner">
      <h2>Inicio de Sesión</h2>

      @if(session('errores'))
      <ul class="err_msgs">
        @foreach(session('errores') as $campo => $mensajes)
        @foreach($mensajes as $mensaje)
        <li class="err_msg">{{ $mensaje }}</li>
        @endforeach
        @endforeach
      </ul>
      @endif
      
      <form class="formulario" action="/login" method="POST" novalidate>
        @csrf
        <label for="email">Correo:</label>
        <input type="email" name="email" value="{{ old('email') }}">
        <label for="password">Contraseña</label>
        <input type="password" name="password">
        <div class="botones">
          <button class="stboton" type="submit">Inicio de Sesión</button>
        </div>
      </form>
    </div>
  </main>

  @include('footer')
</body>

</html>