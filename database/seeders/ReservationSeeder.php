<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use App\Models\RoomDeal;
use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::select('id', 'first_name', 'last_name')->get();
        $roomIds = Room::pluck('id')->toArray();
        $roomDealIds = RoomDeal::pluck('id')->toArray();

        $numReservations = 20; // Change this to the number of reservations you want to create

        for ($i = 1; $i <= $numReservations; $i++) {
            $user = $users[$i % count($users)];

            $reservation = Reservation::factory()->create([
                'user_id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
            ]);

            $roomIndex = array_rand($roomIds);
            $roomDealIndex = array_rand($roomDealIds);

            $reservation->rooms()->attach([
                $roomIds[$roomIndex] => ['room_deal_id' => $roomDealIds[$roomDealIndex]],
            ]);
        }
    }
}
