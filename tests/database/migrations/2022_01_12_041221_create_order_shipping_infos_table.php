<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderShippingInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_shipping_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('company_name')->nullable();
            $table->string('cvr_number')->nullable();
            $table->string('ean_number')->nullable();
            $table->string('shipping_method_type', 300)->nullable();
            $table->text('shipping_method_details')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
            
            $table->foreign('order_id', 'order_shipping_infos_order_id_foreign')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_shipping_infos');
    }
}
