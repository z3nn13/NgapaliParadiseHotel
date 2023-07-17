<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponTable extends Migration
{
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code');
            $table->string('coupon_name');
            $table->integer('uses');
            $table->integer('max_uses');
            $table->integer('max_uses_per_user');
            $table->decimal('discount_amount', 8, 2);
            $table->date('start_date');
            $table->date('expire_date');
            $table->boolean('is_expired')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
