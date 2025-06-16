<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             // rating de 1 a 5
       	    'rating'        => $this->faker->numberBetween(1, 5),

            // comentario opcional
            'comment'       => $this->faker->boolean(70)        // 70 % de probabilidad de que exista
                              ? $this->faker->sentence()
                              : null,

            // usuario autor (se crea si no existe)
            'user_id'       => \App\Models\User::factory(),

            // restaurante reseñado (se crea si no existe)
            'restaurant_id' => \App\Models\Restaurant::factory(),
        ];
    }
}
