<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'num_guests' => fake()->numberBetween(1, 10),
            'check_in_date' => fake()->date(),
            'check_out_date' => fake()->date(),
            'special_request' => fake()->text(),
            'status' => 'active',
        ];
    }
}
