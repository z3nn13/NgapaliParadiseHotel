<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition()
    {
        $roomType = RoomType::inRandomOrder()->first();
        $roomTypeId = $roomType instanceof RoomType ? $roomType->id : null;

        return [
            'room_type_id' => $roomTypeId,
            'room_number' =>  $this->faker->unique()->regexify("/^$roomTypeId-[A-Z]{3}/"),
        ];
    }
}
