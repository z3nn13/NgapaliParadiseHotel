<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations_rooms', function (Blueprint $table) {
            $table->foreignId('reservation_id')->constrained()->onde;
            $table->foreignId('room_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('reservations_rooms');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};