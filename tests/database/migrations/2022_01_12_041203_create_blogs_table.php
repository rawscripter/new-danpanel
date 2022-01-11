<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_category_id');
            $table->integer('status');
            $table->string('title', 191)->nullable();
            $table->string('slug', 191)->nullable();
            $table->longText('description')->nullable();
            $table->string('image', 191)->nullable();
            $table->integer('clicks')->nullable();
            $table->unsignedBigInteger('user_id')->index('blogs_user_id_foreign');
            $table->timestamps();
            $table->integer('category_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
