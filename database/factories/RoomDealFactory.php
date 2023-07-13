<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomDeal>
 */
class RoomDealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $deal_mmk = fake()->numberBetween(35, 90);
        return [
            'deal_name' => fake()->words($nb = 3, $asText = true),
            'deal_mmk' => $deal_mmk * 1000,
            'deal_usd' => number_format((float)$deal_mmk, 2, '.', ''),
            'is_active' => true,
        ];
    }
}
