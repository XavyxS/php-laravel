<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
  public function imagesList()
  {
    // Identificar al usuario activo
    $user = Auth::user();

    // Buscar todas las imágenes del usuario activo
    $images = Image::where('user_id', $user->id)->get();

    // Pasar las imágenes a la vista
    return view('images_list', ['images' => $images]);
  }

  public function upload_img(Request $request)
  {
    // Obtener el ID del usuario autenticado
    $userId = Auth::id();

    // Verifica si el usuario está autenticado
    if ($userId === null) {
      return redirect()->back()->with('error', 'El usuario no está autenticado.');
    }

    $image = $request->file('image');

    // Validar que la imagen sea válida
    if ($image && $image->isValid()) {
      $filename = $image->getClientOriginalName(); // Nombre original del archivo
      $imageData = base64_encode(file_get_contents($image->getPathname())); // Imagen codificada en base64

      // Construir la URL y la clave API desde las variables de entorno
      $url = env('URL_IMGBB');
      $apiKey = env('API_KEY_IMGBB');

      // Hacer la solicitud POST a ImgBB usando Http Facade sin verificar SSL
      $response = Http::withOptions([
        'verify' => false, // Deshabilitar la verificación SSL
      ])->asForm()->post($url, [
        'key' => $apiKey,
        'image' => $imageData,
      ]);

      // Procesar la respuesta
      if ($response->successful() && $response['success']) {
        // Extraer datos de la imagen
        $imageId = $response['data']['id'];
        $imageUrl = $response['data']['url'];
        $urlThumb = $response['data']['thumb']['url'] ?? null;
        $urlDelete = $response['data']['delete_url'];

        // Guardar los datos en la base de datos
        DB::table('images')->insert([
          'user_id' => $userId,
          'image_id' => $imageId,
          'url' => $imageUrl,
          'filename' => $filename,
          'url_thumb' => $urlThumb,
          'url_delete' => $urlDelete,
          'created_at' => now(),
        ]);

        return redirect()->back()->with('message', 'Imagen subida y guardada con éxito.');
      } else {
        return redirect()->back()->with('error', 'Hubo un error al subir la imagen a ImgBB.');
      }
    } else {
      return redirect()->back()->with('error', 'Hubo un error al procesar la imagen.');
    }
  }

  public function delete_img($id)
  {
    // Buscar la imagen por ID y asegurarse de que pertenece al usuario autenticado
    $image = Image::where('id', $id)->first();

    if ($image) {
      // Eliminar la imagen de la base de datos
      $image->delete();

      return redirect()->back()->with('message', 'Imagen eliminada con éxito.');
    } else {
      return redirect()->back()->with('error', 'Imagen no encontrada o no tienes permiso para eliminarla.');
    }
  }
}
