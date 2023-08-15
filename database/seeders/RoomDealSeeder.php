<?php

namespace Database\Seeders;

use App\Models\RoomDeal;
use Illuminate\Database\Seeder;

class RoomDealSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(array $roomTypeIds): void
    {
        $dealData = [];
        foreach ($roomTypeIds as $roomTypeId) { // Use $roomTypeIds instead of $roomTypes
            $usdAmount = rand(20, 35);

            $deals = [
                $this->createDeal($roomTypeId, "Room Only", $usdAmount),
                $this->createDeal($roomTypeId, "Breakfast + Bed", $usdAmount + 5),
                $this->createDeal($roomTypeId, "Extrabed + All Inclusive", $usdAmount + 15),
            ];

            $dealData = array_merge($dealData, $deals);
        }
        RoomDeal::insert($dealData);
    }

    private function createDeal($roomTypeId, $dealName, $usdAmount): array
    {
        return [
            "room_type_id" => $roomTypeId, // Include the room type ID
            "deal_name" => $dealName,
            "deal_mmk" => $this->calculateDealMMK($usdAmount),
            "is_active" => true,
        ];
    }

    private function calculateDealMMK($usdAmount): int
    {
        return $usdAmount * 2000;
    }
}
