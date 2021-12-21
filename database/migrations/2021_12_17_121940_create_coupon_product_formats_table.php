<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponProductFormatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_product_formats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("coupon_id");
            $table->unsignedBigInteger("product_format_id");

            $table->foreign("product_format_id")->references("id")->on("product_formats");
            $table->foreign("coupon_id")->references("id")->on("coupons");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_product_formats');
    }
}
