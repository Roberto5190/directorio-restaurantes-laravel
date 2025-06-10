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
        Schema::create('reviews', function (Blueprint $table) {
	    //Tabla de reseñas de usuarios sobre restaurantes
	    $table->bigIncrements('id'); //PK autoincremental
	    $table->unsignedTinyInteger('rating'); //rating: entero 1-5, requerido
	    $table->text('comment')->nullable(); //comment: texto libre, opcional
	    $table->foreignId('user_id') //FK user_id -> users.id (autor de la reseña)
                  ->constrained()
                  ->cascadeOnDelete();
            $table->foreignId('restaurant_id') //FK restaurant_id -> restaurants.id (restaurante reseñado)
	  	  ->constrained()
		  ->cascadeOnDelete();
            $table->timestamps();
	    $table->unique(['user_id', 'restaurant_id']); //Índice compuesto para evitar que el mismo usuario reseñe dos veces un restaurante
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
