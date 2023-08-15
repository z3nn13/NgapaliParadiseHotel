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
        $deal_usd = rand(20, 35);
        return [
            'deal_name' => fake()->words($nb = 3, $asText = true),
            'deal_mmk' => $deal_usd * 2000,
            'is_active' => true,
        ];
    }
}
