<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('event_id', 191)->nullable();
            $table->boolean('is_offer_expirable')->default(0);
            $table->string('product_channel', 300)->nullable();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->text('short_des')->nullable();
            $table->text('full_des')->nullable();
            $table->string('total_favourites')->default('0');
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->double('market_price', 8, 2)->nullable();
            $table->double('offer_price', 8, 2)->nullable();
            $table->double('last_price', 8, 2)->nullable();
            $table->string('product_type', 191)->nullable();
            $table->integer('total_clicks')->default(0);
            $table->integer('total_offer_spots')->nullable();
            $table->double('minus_price_user_price', 8, 2)->nullable();
            $table->float('current_price')->nullable();
            $table->float('join_price')->nullable();
            $table->float('join_price_percentage')->nullable();
            $table->integer('max_unit_per_user')->nullable();
            $table->timestamp('expire_date')->nullable();
            $table->float('save_price')->default(0);
            $table->text('order_note')->nullable();
            $table->timestamp('offer_start_date')->nullable();
            $table->integer('total_likes')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_archive')->default(0);
            $table->integer('priority')->nullable();
            $table->timestamps();
            
            $table->foreign('category_id', 'products_category_id_foreign')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('sub_category_id', 'products_sub_category_id_foreign')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->foreign('user_id', 'products_user_id_foreign')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
