<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->increments('follow_id');
            $table->integer('userFollower_id') -> unsigned(); // User who follow followed another user
            $table->integer('userFollowed_id') -> unsigned(); // User was followed by another user
            $table->timestamp('follow_created_at');
            // Foreign Keys
            $table->foreign('userFollower_id') -> references('id') -> on('users')->onDelete('cascade');
            $table->foreign('userFollowed_id') -> references('id') -> on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
