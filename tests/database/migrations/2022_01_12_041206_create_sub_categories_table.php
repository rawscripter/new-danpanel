<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('channel', 300)->nullable();
            $table->unsignedBigInteger('category_id');
            $table->string('name')->nullable();
            $table->string('icon', 300)->nullable();
            $table->string('slug')->nullable();
            $table->integer('priority')->default(0);
            $table->integer('is_archive')->default(0);
            $table->timestamps();
            
            $table->foreign('category_id', 'sub_categories_category_id_foreign')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
}
