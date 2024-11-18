<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Imágenes</title>
  <link rel="stylesheet" href="css/styles.css">

</head>

<script>
  document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('image').addEventListener('change', function() {
      var archivo = this.files[0];
      var fileNameSpan = document.getElementById('file_name');
      if (archivo) {
        fileNameSpan.textContent = "Archivo seleccionado: " + archivo.name;
      } else {
        fileNameSpan.textContent = "Ningún archivo seleccionado";
      }
    })
  });
</script>

<body>
  @include('header')
  <main>
    <div class="conteiner">
      <h2>Banco de Imágenes</h2>
      @if($images->isEmpty())
      <h3> No hay imágenes para mostrar.</h3>
      @else
      <table class="tabla">
        <tr>
          <th>ID</th>
          <th>Imagen</th>
          <th>Nombre</th>
          <th>Fecha de subida</th>
          <th>Acciones</th>
        </tr>
        @foreach ($images as $image)
        <tr>
          <td>{{ $image->id }} </td>
          <td><img src="{{ $image->url_thumb }}" class="thumb_img" alt="{{ $image->filename }}"></td>
          <td>{{ $image->filename }}</td>
          <td>{{ $image->created_at->format('d/m/Y H:i') }}</td>
          <td>
            <a href="{{ $image->url }}" target="_blank">Ver</a>
            <a href="/delete_img/{{ $image->id }}" onclick="return confirm('¿Estás seguro de que deseas eliminar la imagen: ')">Eliminar</a>
          </td>
        </tr>
        @endforeach
        @endif
      </table>
      <div class="form_input_file">
        <form action="/upload_img" method="POST" enctype="multipart/form-data">
          @csrf
          <label class="stboton" for="image">Seleccionar Archivo</label><br><br>
          <input class="stboton" type="file" name="image" id="image" hidden>
          <span class="nombre_archivo" id="file_name">Ningún archivo seleccionado</span><br>
          <button class="stboton" name="enviar">Enviar</button>
        </form>
      </div>
      <div class="botones">
        <a class="stboton rdboton" href="/dashboard">Menú Principal</a>
      </div>
    </div>
  </main>




  @include('footer')

</body>

</html>