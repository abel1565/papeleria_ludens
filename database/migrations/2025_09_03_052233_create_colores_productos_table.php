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
        {
            Schema::create('colores_productos', function (Blueprint $table) {
                $table->id();
        
                // Primero defines las columnas
                $table->unsignedBigInteger('color_id');
                $table->unsignedBigInteger('producto_id');
        
                // Después defines las llaves foráneas
                $table->foreign('color_id')
                      ->references('id')->on('colores')
                      ->onDelete('cascade');
        
                $table->foreign('producto_id')
                      ->references('id')->on('productos')
                      ->onDelete('cascade');
        
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colores_productos');
    }
};
