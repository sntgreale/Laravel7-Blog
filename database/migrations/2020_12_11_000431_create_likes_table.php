<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->increments('like_id');
            $table->integer('like_user_id') -> unsigned(); // User that like the post
            $table->integer('like_post_id') -> unsigned(); // Post that be liked
            $table->timestamp('like_created_at');
            // Foreign Keys
            $table->foreign('like_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('like_post_id')->references('post_id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
