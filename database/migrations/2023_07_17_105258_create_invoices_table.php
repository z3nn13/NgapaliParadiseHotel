<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained('reservations')->onDelete("cascade");
            $table->foreignId('pay_type_id')->nullable()->constrained('pay_types');
            $table->foreignId('coupon_id')->nullable()->constrained('coupons');
            $table->decimal('total_amount', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['reservation_id', 'pay_type_id', 'coupon_id']);
        });
        Schema::dropIfExists('invoices');
    }
}
