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
        Schema::create('photos', function (Blueprint $table) {
	    //Tabla de fotos polimorficas (restaurant, user, etc.)
	    $table->bigIncrements('id');
	    $table->string('url'); // url: ruta o URL de la imagen, requerida
	    
	    //Campos polimórficos
            $table->unsignedBigInteger('imageable_id'); //id del modelo propietario
	    $table->string('imageable_type'); //imageable_type: nombre de la clase ('App\Models\\Restaurant', etc)

            $table->timestamps();
	    
	    $table->index(['imageable_type', 'imageable_id']); //Índice comnbinado para acelerar la consulta polimorfica
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
