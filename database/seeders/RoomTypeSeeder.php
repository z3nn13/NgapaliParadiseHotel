<?php

namespace Database\Seeders;


use App\Models\RoomType;
use App\Models\RoomCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomTypeSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomTypes = $this->get_room_types();

        RoomCategory::create(['room_category_name' => "Beachfront Sea View"]);
        RoomCategory::create(['room_category_name' => "Partial Sea View"]);

        foreach ($roomTypes as $roomType) {
            $roomType = RoomType::create($roomType);
            $this->create_room_deals($roomType);
            $this->create_rooms($roomType);
        }
    }


    public function create_room_deals(RoomType $roomType)
    {

        /* Create Room Deals Data */
        $deal_usd =  rand(30, 60);
        $roomType->room_deals()->createMany([
            [
                "room_type_id" => $roomType["id"],
                "deal_name" => "Room Only",
                "deal_mmk" => $deal_usd * 2000,
                "deal_usd" => $deal_usd,
                "is_active" => true,
            ],
            [
                "room_type_id" => $roomType["id"],
                "deal_name" => "Breakfast + Bed",
                "deal_mmk" => ($deal_usd + 10) * 2000,
                "deal_usd" => $deal_usd,
                "is_active" => true,
            ],
            [
                "room_type_id" => $roomType["id"],
                "deal_name" => "Extrabed + All Inclusive",
                "deal_mmk" => ($deal_usd + 30) * 2000,
                "deal_usd" => $deal_usd,
                "is_active" => true,
            ],
        ]);
    }


    public function create_rooms(RoomType $roomType)
    {
        $roomLetter = range('A', 'C');

        foreach ($roomLetter as $letter) {
            $roomNumber = $roomType["id"] . $letter;
            $roomType->rooms()->create([
                "room_type_id" => $roomType["id"],
                'room_number' => $roomNumber,
            ]);
        }
    }


    public function get_room_types(): array
    {
        return [
            [
                "id" => 1,
                "room_type_name" => "Beachfront Sea View Queen",
                "room_image" => "/images/rooms/room_2.jpg",
                "occupancy" => 3,
                "view" => "Beach",
                "bedding" => "1 Queen Bed",
                "description" => "Step into a timeless sanctuary with direct ocean access, where the rhythmic embrace of blissful waves awaits you.",
                "room_category_id" => 1,
            ],
            [
                "id" => 2,
                "room_type_name" => "Partial Sea View King Bed",
                "room_image" => "/images/rooms/room_7.webp",
                "occupancy" => 2,
                "view" => "Partial Sea",
                "bedding" => "1 Double Bed",
                "description" => "Nestled amidst lush greenery, this hidden gem captures gentle sea views, offering tranquility on a private terrace.",
                "room_category_id" => 2,
            ],
            [
                "id" => 3,
                "room_type_name" => "Beachfront Sea View King Bed",
                "room_image" => "/images/rooms/room_7.webp",
                "occupancy" => 2,
                "view" => "Beach",
                "bedding" => "1 King Bed",
                "description" => "An exquisitely spacious room awaits, featuring a private balcony with mesmerizing views of rolling waves and stunning sunsets.",
                "room_category_id" => 1,
            ],
        ];
    }
}
