<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'coupon_code' => $this->faker->unique()->regexify('[A-Z0-9]{8}'),
            'coupon_name' => $this->faker->words(3, true),
            'uses' => 0,
            'max_uses' => $this->faker->numberBetween(50, 200),
            'discount_percentage' => $this->faker->numberBetween(10, 50),
            'start_date' => Carbon::now(),
            'expire_date' => Carbon::now()->addDays($this->faker->numberBetween(30, 180)),
            'is_expired' => false,
        ];
    }
}
