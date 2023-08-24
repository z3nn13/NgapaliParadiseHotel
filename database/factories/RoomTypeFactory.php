<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomType>
 */
class RoomTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "room_type_name" => $this->faker->sentence(4),
            "room_image" => "https://source.unsplash.com/random/350x200",
            "occupancy" => $this->faker->numberBetween(1, 6),
            "view" => $this->faker->word,
            "bedding" => $this->faker->randomElement(['1 Queen Bed', '2 Double Bed', '1 King Bed']),
            "description" => $this->faker->paragraph,
            "room_category_id" => $this->faker->numberBetween(1, 2),
        ];
    }
}
