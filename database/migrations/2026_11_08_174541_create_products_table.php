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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Identificador único (1, 2, 3...)
            
            // --- NUEVAS COLUMNAS PARA VECTRA ---
            $table->string('nombre');                  // El nombre del equipo o producto
            $table->text('descripcion')->nullable();   // Descripción larga (nullable significa que puede dejarse en blanco)
            $table->decimal('precio', 8, 2);           // El precio (ej: 149.99)
            $table->integer('stock');                  // Cantidad disponible en el almacén
            $table->string('imagen')->nullable();            // Ruta o enlace de la foto del producto
            // -----------------------------------

            $table->timestamps(); // Fecha de creación y última modificación automáticas
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};