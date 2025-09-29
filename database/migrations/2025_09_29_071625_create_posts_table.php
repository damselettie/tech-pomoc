<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->json('title');    // Przechowuje tytuły w różnych językach jako JSON
        $table->json('content');  // Przechowuje treści w różnych językach jako JSON
        $table->timestamps();     // created_at i updated_at
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
