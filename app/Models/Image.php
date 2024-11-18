<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  // Especifica los atributos que se pueden asignar en masa
  protected $fillable = ['user_id', 'image_id', 'url', 'filename', 'url_thumb', 'url_delete'];
}
