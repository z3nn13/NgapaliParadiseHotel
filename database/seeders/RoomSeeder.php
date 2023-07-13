<?php

namespace Database\Seeders;


use App\Models\RoomDeal;
use App\Models\RoomType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomTypes = [
            [
                "id" => 1,
                "room_type_name" => "Beachfront View King Bed",
                "occupancy" => "3",
                "view" => "Full Sea",
                "bedding" => "1 King Bed",
                "description" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Incidunt, non!"
            ],
            [
                "id" => 2,
                "room_type_name" => "Partial Sea View King Bed",
                "occupancy" => "2",
                "view" => "Partial Sea",
                "bedding" => "1 King Bed",
                "description" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Incidunt, non!"
            ],
        ];


        foreach ($roomTypes as $roomType) {
            RoomType::create($roomType);
            RoomDeal::factory(3)->create(
                [
                    "room_type_id" => $roomType["id"]
                ]
            );
        }
    }
}
