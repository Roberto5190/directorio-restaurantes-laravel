<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class Restaurant extends Model
{
    use HasFactory;


    protected $fillable = [
	'name',
	'address',
	'phone',
	'user_id',

    ];
    
   //El propietario del restaurante. 
   //Un restaurante pertenece a un usuario.
   public function user()
   {
	return $this->belongsTo(User::class); 
   }

   //Categorías (muchos a muchos) del restaurante.
   public function categories()
   {
	return $this->belongsToMany(Category::class);
   }

   //Reseñas asociadas (muchos a muchos) del restaurante.
   public function reviews()
   {
	return $this->hasMany(Review::class);
   }

   //Fotos asociadas (relacion polimorfica)
   public function photos()
   {
	return $this->morphMany(Photo::class, 'imageable');
   }

   /**
   * Usuarios que han marcado este restaurante como favorito.
   */
   public function favoritedBy() 
   {
       return $this->belongsToMany(User::class, 'favorites')
                   ->withTimestamps();
   }



}
 
