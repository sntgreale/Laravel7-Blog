<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('comment_id');
            $table->string('comment_title');
            $table->text('comment_body');
            $table->integer('comment_user_id') -> unsigned();
            $table->integer('comment_post_id') -> unsigned();
            $table->timestamp('comment_created_at');
            // Foreign Keys
            $table->foreign('comment_user_id') -> references('id') -> on('users')->onDelete('cascade');
            $table->foreign('comment_post_id') -> references('post_id') -> on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
