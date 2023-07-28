<?php

namespace Database\Seeders;

use App\Models\PayType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PayType::create(['pay_type_name' => 'paypal',]);
        PayType::create(['pay_type_name' => 'card',]);
    }
}
