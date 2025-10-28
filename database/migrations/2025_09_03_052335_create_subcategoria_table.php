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
        Schema::create('subcategoria', function (Blueprint $table) {
            $table->id();

            // Primero defines la columna
            $table->unsignedBigInteger('categoria_id');
        
            // Luego la relación
            $table->foreign('categoria_id')->references('id')->on('categoria')->onDelete('restrict'); // o cascade / set null
        
            $table->string('subcategoria');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategoria');
    }
};
