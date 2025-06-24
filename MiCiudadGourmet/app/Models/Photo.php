<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /** @use HasFactory<\Database\Factories\PhotoFactory> */
    use HasFactory;

    // Campos que se pueden asignar en masa
    protected $fillable = [
	'url',
	'imageable_id',
	'imageable_type',
    ];

     /**
     * Relación polimórfica inversa.
     * Devuelve el modelo propietario (Restaurant, User, etc.).
     */
    public function imageable()
    {
        return $this->morphTo();
    }

}
