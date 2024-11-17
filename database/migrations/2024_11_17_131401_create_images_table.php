<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('images', function (Blueprint $table) {
      $table->id(); // id (Primary Key)
      $table->string('user_id'); // user_id (Foreign Key)
      $table->string('image_id', 50)->unique(); // image_id (Unique Constraint)
      $table->string('url', 255); // url
      $table->string('filename', 100); // filename
      $table->string('url_thumb', 255)->nullable(); // url_thumb
      $table->string('url_delete', 255)->nullable(); // url_delete
      $table->timestamp('created_at'); // created_at
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('images');
  }
};
