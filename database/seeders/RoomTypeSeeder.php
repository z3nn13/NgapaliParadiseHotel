<?php

namespace Database\Seeders;


use App\Models\RoomType;
use App\Models\RoomCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomTypeSeeder extends Seeder
{
    use HasFactory;

    /*
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seeding Dependency
        $this->call(RoomCategorySeeder::class);
        // Seeding Model
        $roomTypesData = $this->getCustomRoomTypes();
        RoomType::insert($roomTypesData);

        // Seeding HasMany Relationships
        $roomTypeIds = array_column($roomTypesData, 'id');
        $this->callWith(RoomDealSeeder::class, compact('roomTypeIds'));
        $this->callWith(RoomSeeder::class, compact('roomTypeIds'));
    }


    public function getCustomRoomTypes(): array
    {
        return [
            [
                "id" => 1,
                "room_type_name" => "Beachfront Sea View Queen Bed",
                "room_image" => "/images/rooms/room_card_1.png",
                "occupancy" => 3,
                "view" => "Beach",
                "bedding" => "1 Queen Bed",
                "description" => "Step into a timeless sanctuary with direct ocean access, where the rhythmic embrace of blissful waves awaits you.",
                "room_category_id" => 1,
            ],
            [
                "id" => 2,
                "room_type_name" => "Partial Sea View King Bed",
                "room_image" => "/images/rooms/room_card_2.png",
                "occupancy" => 2,
                "view" => "Partial Sea",
                "bedding" => "1 Double Bed",
                "description" => "Nestled amidst lush greenery, this hidden gem captures gentle sea views, offering tranquility on a private terrace.",
                "room_category_id" => 2,
            ],
            [
                "id" => 3,
                "room_type_name" => "Beachfront Sea View King Bed",
                "room_image" => "/images/rooms/room_card_3.png",
                "occupancy" => 2,
                "view" => "Beach",
                "bedding" => "1 King Bed",
                "description" => "An exquisitely spacious room awaits, featuring a private balcony with mesmerizing views of rolling waves and stunning sunsets.",
                "room_category_id" => 1,
            ],
        ];
    }
}
