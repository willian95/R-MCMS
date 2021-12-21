<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_purchases', function (Blueprint $table) {
            $table->id();

            $table->integer("amount");
            $table->double("price", 12, 4);
            $table->unsignedBigInteger("payment_id");
            $table->foreign("payment_id")->references("id")->on("payments");
            $table->unsignedBigInteger("product_format_id");
            $table->foreign("product_format_id")->references("id")->on("product_formats");

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
        Schema::dropIfExists('product_purchases');
    }
}
