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
        Schema::create('favorites', function (Blueprint $table) {
	    // Pivote n:n de usuarios y restaurantes marcados como favoritos
	    $table->foreignId('user_id') //FK user_id -> users.id
		  ->constrained()
	          ->cascadeOnDelete();
	    
	    $table->foreignId('restaurant_id')
		  ->constrained()
		  ->cascadeOnDelete();
	    
	    $table->primary(['user_id', 'restaurant_id']); //Clave primaria compuesta evita duplicados

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
