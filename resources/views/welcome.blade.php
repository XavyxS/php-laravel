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
    <div class="hero">
      <h1>Bienvenidos a<p><strong>JM</strong><span class="software">SOFTWARE</span></p>
      </h1>
      <h2>Desarrollando el Software del presente y del futuro</h2>
      <div class="presentacion">
        <P>Esta aplicación es la Actividad Final de la materia <strong>Lenguage de Programación Backend</strong>
          del Tercer Semestre de la Carrera: <strong>Desarrollo de Sistemas Web. </strong>
          <br><br>
          Esta aplicación es un <strong> Banco de Imágenes individuales</strong> para cada usuario. La App pide el registro
          del Usuario para poder Iniciar Sesión. La App revisa que todos los campos del Registro sen válidos y que el Usuario no se encuentre
          ya registrado. Una vez registrado el Usuario, podrá Iniciar Sesión y acceder a su Banco de Imágenes donde podrá subir
          imágenes que se guardarán en un sitio en la nube. También podrá ver las imágenes guardadas y eliminarlas si así lo desea.
          <br><br>
          Para el desarrollo de esta aplicación se uso:
        <ul class="recursos">
          <li>Editor: Visual Studio Code</li>
          <li>Lenguages: HTML, PHP, JavaScript y CSS</li>
          <li>Framework: Laravel</li>
          <li>Base de Datos: PostgreSQL</li>
          <li>Deploy en: Railway.app</li>
          <li>Banco de imágenes: imgbb.com</li>
        </ul>
        </P>
      </div>
    </div>
  </main>

  @include('footer')
</body>

</html>