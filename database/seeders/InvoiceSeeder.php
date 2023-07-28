<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservations = Reservation::count();
        for ($i = 1; $i <= $reservations; $i++) {
            Invoice::create([
                'reservation_id' => $i,
                'pay_type_id' => 2,
                'total_paid_mmk' => 66000,
                'preferred_currency' => 'USD',
            ]);
        }
    }
}
