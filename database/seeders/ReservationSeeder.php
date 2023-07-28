<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reservation::factory(20)->create();
        DB::table('reservation_rooms')->insert(
            [
                'room_id' => 1,
                'reservation_id' => 1,
                'room_deal_id' => 1
            ]
        );
    }
}
