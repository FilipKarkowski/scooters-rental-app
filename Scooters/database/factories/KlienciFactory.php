<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Klienci>
 */
class KlienciFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Imie' => $this->faker->city,
            'Nazwisko' => $this->faker->city,
            'Telefon' => $this->faker->city,
        ];
    }
}
