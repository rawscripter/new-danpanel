<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id', 300)->nullable();
            $table->string('custom_order_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('quantity')->nullable();
            $table->double('join_price', 8, 2)->unsigned()->nullable();
            $table->double('current_price', 8, 2)->unsigned()->nullable();
            $table->double('total_price', 8, 2)->unsigned()->nullable();
            $table->float('shipping_cost')->nullable();
            $table->boolean('is_join_payment_enable')->nullable();
            $table->boolean('is_join_price_paid')->default(0);
            $table->boolean('is_full_price_paid')->default(0);
            $table->boolean('order_status')->default(0);
            $table->boolean('is_canceled')->default(0);
            $table->text('variations')->nullable();
            $table->timestamp('payment_deadline')->nullable();
            $table->float('variant_total')->default(0);
            $table->integer('canceled_by')->nullable();
            $table->timestamps();
            
            $table->foreign('product_id', 'orders_product_id_foreign')->references('id')->on('products');
            $table->foreign('user_id', 'orders_user_id_foreign')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
