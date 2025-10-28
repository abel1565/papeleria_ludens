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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('name');                          // Nombre del producto
            $table->string('code')->unique();                // Código del producto (ej: PD14ZX)
            $table->integer('stock')->default(0);            // Cantidad disponible
            
            // Detalles de venta
            $table->decimal('price', 10, 2);                 // Precio por pieza
            $table->integer('pieces_per_package')->nullable();  // Piezas por paquete
            $table->integer('pieces_per_box')->nullable();      // Piezas por empaque
            $table->text('sale_note')->nullable();           // Nota de venta (ej. venta en múltiplos)
            
            // Descripción y características
            $table->text('description')->nullable();         // Descripción detallada
            $table->string('material')->nullable();          // Material (ej. plástico)
            $table->string('colors')->nullable();            // Colores disponibles (string separados por coma)
            $table->integer('models')->nullable();           // Modelos disponibles (ej. 6)
            $table->string('measurements')->nullable();      // Medidas (ej. 38x26.5 cm)
            $table->integer('separators')->nullable();       // Número de separadores
            $table->text('extra_notes')->nullable();         // Notas adicionales
            // Datos físicos
            $table->decimal('weight', 8, 3)->nullable();     // Peso (ej. 0.350 g)
            $table->string('barcode')->nullable();           // Código de barras
            $table->string('sku')->nullable();
            $table->string('image')->nullable();             // Una sola foto
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
