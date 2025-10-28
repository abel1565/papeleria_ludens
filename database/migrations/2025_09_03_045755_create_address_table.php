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
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('cp'); // código postal
            $table->string('estado');
            $table->string('municipio');
            $table->string('ciudad');
            $table->string('calle');
            $table->string('num_ext');
            $table->string('num_int')->nullable();
            $table->string('edificio')->nullable();
            $table->string('entre_calle')->nullable();
            $table->string('y_calle')->nullable();
            $table->string('num_celular'); // usar string en lugar de integer
            $table->string('num_particular')->nullable(); // nullable por si no hay
            $table->unsignedBigInteger('user_id'); // columna para la FK
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
