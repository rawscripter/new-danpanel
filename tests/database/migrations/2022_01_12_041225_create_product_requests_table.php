<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name', 300)->nullable();
            $table->string('phone', 300)->nullable();
            $table->unsignedBigInteger('product_id');
            $table->string('cvr_number', 300)->nullable();
            $table->string('email');
            $table->string('type');
            $table->string('note');
            $table->boolean('mail_status')->default(0);
            $table->text('variations')->nullable();
            $table->timestamps();
            
            $table->foreign('product_id', 'product_requests_product_id_foreign')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_requests');
    }
}
