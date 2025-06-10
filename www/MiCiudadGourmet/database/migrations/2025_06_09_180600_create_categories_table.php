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
        Schema::create('categories', function (Blueprint $table) {
	    //Tabla de categorias de restaurantes
	    $table->bigIncrements('id'); //PK autoincremental
	    $table->string('name', 100)->unique(); //name: nombre visible, único para no repetir categorias
	    $table->string('slug', 100)->nullable()->unique(); //slug: URL amigable
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
