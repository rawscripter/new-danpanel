<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporaryOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_orders', function (Blueprint $table) {
            $table->id();
            $table->string('custom_order_id')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('quantity');
            $table->double('join_price', 8, 2)->unsigned();
            $table->double('current_price', 8, 2)->unsigned();
            $table->double('total_price', 8, 2)->unsigned();
            $table->text('variations')->nullable();
            $table->boolean('is_join_payment_enable');
            $table->boolean('is_join_price_paid')->default(0);
            $table->boolean('is_paid_full_price')->default(0);
            $table->float('variant_total')->default(0);
            $table->timestamps();
            
            $table->foreign('product_id', 'temporary_orders_product_id_foreign')->references('id')->on('products');
            $table->foreign('user_id', 'temporary_orders_user_id_foreign')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temporary_orders');
    }
}
