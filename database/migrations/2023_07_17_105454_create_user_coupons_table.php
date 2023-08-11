<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('user_coupons', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete("cascade");
            $table->foreignId('coupon_id')->constrained('coupons')->onDelete("cascade");
            $table->integer('uses')->default(0);
            $table->boolean('limit_reached')->default(false);
            $table->timestamps();
            $table->primary(['user_id', 'coupon_id']);
        });
    }

    public function down()
    {
        Schema::table('user_coupons', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'coupon_id']);
        });
        Schema::dropIfExists('user_coupons');
    }
}