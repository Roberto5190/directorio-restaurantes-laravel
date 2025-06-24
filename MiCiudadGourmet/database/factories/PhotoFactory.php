<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url'            => $this->faker->imageUrl(640, 480, 'food'),
            // Por defecto la foto pertenecerá a un restaurante nuevo
            'imageable_id'   => \App\Models\Restaurant::factory(),
            'imageable_type' => \App\Models\Restaurant::class,
        ];
    }
}
