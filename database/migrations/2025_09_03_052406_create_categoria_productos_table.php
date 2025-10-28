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
        Schema::create('categoria_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('productos_id');
            $table->unsignedBigInteger('subcategoria_id');
            $table->foreign('productos_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('subcategoria_id')->references('id')->on('subcategoria')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_productos');
    }
};
