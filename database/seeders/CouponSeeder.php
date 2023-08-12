<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coupons = [
            ['coupon_code' => 'CODE1'],
            ['coupon_code' => 'CODE2'],
            ['coupon_code' => 'CODE3'],
        ];

        foreach ($coupons as $couponAttributes) {
            Coupon::factory()->create($couponAttributes);
        }
    }
}
