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
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string("room_type_name");
            $table->foreignId("room_category_id")->constrained("room_categories");
            $table->string("room_image")->nullable();
            $table->integer("occupancy");
            $table->string("view");
            $table->string("bedding");
            $table->text("description")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservation_room', function (Blueprint $table) {
            $table->dropForeign(['reservation_id']);
            $table->dropForeign(['room_id']);
            $table->dropForeign(['room_deal_id']);
        });
        Schema::dropIfExists('room_types');
    }
};
