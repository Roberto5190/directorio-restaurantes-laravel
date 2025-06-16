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
        Schema::create('category_restaurant', function (Blueprint $table) {
            //Pivote n:n entre restaurantes y categorias

           // FK restaurant_id -> restaurants.id
           $table->foreignId('restaurant_id')
                 ->constrained()        // por convención: restaurants.id
                 ->cascadeOnDelete();   // si se elimina el restaurante, borra filas asociadas

           // FK category_id -> categories.id
           $table->foreignId('category_id')
                ->constrained()        // por convención: categories.id
                ->cascadeOnDelete();

           // Clave primaria compuesta para evitar duplicados
           $table->primary(['restaurant_id', 'category_id']);
	    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_restaurant');
    }
};
