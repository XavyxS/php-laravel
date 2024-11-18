<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Usuario</title>
  <link rel="stylesheet" href="css/styles.css">

</head>

<body>
  @include('header')
  <main>
    <div class="conteiner">
      <h2>Registro de Usuario</h2>
      @if(session('errores'))
      <ul>
        @foreach(session('errores') as $campo => $mensajes)
        @foreach($mensajes as $mensaje)
        <li>{{ $mensaje }}</li>
        @endforeach
        @endforeach
      </ul>
      @endif
      <form class="formulario" action="/registro" method="POST" novalidate>
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" name="name" value="{{ old('name') }}">
        <label for="email">Correo:</label>
        <input type="email" name="email" value="{{ old('email') }}">
        <label for="password">Contraseña</label>
        <input type="password" name="password">
        <div class="botones">
          <button class="stboton" type="submit">Registro</button>
        </div>
      </form>
    </div>
  </main>

  @include('footer')
</body>

</html>