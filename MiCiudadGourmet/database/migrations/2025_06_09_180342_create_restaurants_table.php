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
        Schema::create('restaurants', function (Blueprint $table) {
	// Tabla de restaurantes creados / gestionados por los usuarios propietarios
	
	    $table->bigIncrements('id'); //PK autoincremental
	    $table->string('name', 100); //name: nombre comercial, requerido, max 100 caracteres
            $table->string('address'); //address: direccion fisica, requerido
	    $table->int('phone', 20)->nullable(); //phone: telefono de contacto, opcional, max 20 digitos 
	    
	    //foreign: user_id -> users.id, cascade on delete
	    $table->foreignId('user_id')
		  ->constrained() //infiere tabla users y campo id
		  ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
