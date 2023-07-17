<?php

namespace Database\Seeders;


use App\Models\Room;
use App\Models\RoomDeal;
use App\Models\RoomType;
use App\Models\Reservation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class RoomTypeSeeder extends Seeder
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
                "room_image" => "/images/rooms/room_2.jpg",
                "occupancy" => "3",
                "view" => "Full Sea",
                "bedding" => "1 King Bed",
                "description" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Incidunt, non!"
            ],
            [
                "id" => 2,
                "room_type_name" => "Partial Sea View King Bed",
                "room_image" => "/images/rooms/room_7.webp",
                "occupancy" => "2",
                "view" => "Partial Sea",
                "bedding" => "1 King Bed",
                "description" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Incidunt, non!"
            ],
        ];


        foreach ($roomTypes as $roomType) {
            RoomType::create($roomType);
            Room::create(["room_type_id" => $roomType["id"]]);
            Room::create(["room_type_id" => $roomType["id"]]);
            Room::create(["room_type_id" => $roomType["id"]]);
            RoomDeal::factory(3)->create(["room_type_id" => $roomType["id"]]);
            Reservation::factory()->create(
                [
                    "user_id" => 1,
                    "deal_id" => 1,
                ]
            );
        }
        DB::table('reservations_rooms')->insert(
            [
                'room_id' => 1,
                'reservation_id' => 1,
            ]
        );
    }
}
