<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(array $roomTypeIds): void
    {
        $roomData = [];
        foreach ($roomTypeIds as $roomTypeId) {
            $roomCount = $this->generateRandomRoomCount();
            $roomLetters = $this->generateRoomLetters($roomCount);

            $rooms = $this->createRoomsForType($roomTypeId, $roomLetters);
            $roomData = array_merge($roomData, $rooms);
        }

        Room::insert($roomData);
    }

    private function generateRandomRoomCount(): int
    {
        return rand(2, 4);
    }


    private function generateRoomLetters(int $count): array
    {
        return range('A', chr(65 + $count - 1));
    }


    private function createRoomsForType($roomTypeId, array $roomLetters): array
    {
        $rooms = [];
        foreach ($roomLetters as $letter) {
            $roomNumber = "{$roomTypeId}{$letter}";
            $rooms[] = [
                "room_type_id" => $roomTypeId,
                'room_number' => $roomNumber,
            ];
        }

        return $rooms;
    }
}
