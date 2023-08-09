<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'user_image' => 'images/avatars/profile2.jpg',
            'role_id' => 1,
            'email' => 'test@example.com',
        ]);
        User::factory()->create([
            'user_image' => 'images/avatars/profile1.jpg',
            'role_id' => 2,
            'email' => 'admin@example.com',
        ]);
    }
}
