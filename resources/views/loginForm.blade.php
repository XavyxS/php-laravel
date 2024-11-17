<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JS Software</title>
</head>
<link rel="stylesheet" href="css/styles.css">

<body>
  @include('header')
  <main>
    <div class="conteiner">
      <h2>Inicio de Sesión</h2>
      <form class="formulario" action="/auth" method="POST">
        <label for="email">Correo:</label>
        <input type="email" name="email" require>
        <label for="password">Contraseña</label>
        <input type="password" name="password" require>
        <div class="botones">
          <button class="stboton" type="submit">Iniciar Sesión</button>
        </div>
      </form>
    </div>
  </main>
  @include('footer')
</body>

</html>