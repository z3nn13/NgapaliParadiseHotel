<?php

namespace Database\Seeders;

use App\Models\RoomCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomCategory::create(['room_category_name' => "Beachfront Sea View"]);
        RoomCategory::create(['room_category_name' => "Partial Sea View"]);
    }
}
