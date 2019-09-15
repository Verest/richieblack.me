<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('meta');
            $table->text('body');
            $table->timestamps();
        });

        Schema::create('image_post', function (Blueprint $table) {
            $table->integer('post_id', false, true);
            $table->integer('image_id', false, true);
            $table->boolean('is_default');

            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('image_id')->references('id')->on('images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('image_post');
    }
}
