<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reposts', function (Blueprint $table) {
            $table->increments('repost_id');
            $table->integer('repost_user_id') -> unsigned(); // User that repost the post
            $table->integer('repost_post_id') -> unsigned(); // Post that be resposted
            $table->timestamp('repost_created_at');
            // Foreign Keys
            $table->foreign('repost_user_id')->references('id')->on('users');
            $table->foreign('repost_post_id')->references('post_id')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reposts');
    }
}
