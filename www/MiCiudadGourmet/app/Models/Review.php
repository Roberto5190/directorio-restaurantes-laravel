<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

   //Campos que se pueden asignar en masa
   protected $fillable = [
   	'rating',
	'comment',
	'user_id',
	'restaurant_id',

   ];


   // Relaciones
   
   //Autor de la reseña 
   public function user()
   {
	return $this->belongsTo(User::class); 
   }


   // Restaurante reseñado
   public function restaurant()
   {
	return $this->belongsTo(Restaurant::class);
   }

}
