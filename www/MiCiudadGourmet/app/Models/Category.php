<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    //Campos que se pueden asignar en masa
    protected $fillable = [
	'name',
	'slug',
    ];

    //Restaurantes asociados (muchos a muchos)
    public function restaurants()
    {
   	return $this->belongsToMany(Restaurant::class);
    }

}
