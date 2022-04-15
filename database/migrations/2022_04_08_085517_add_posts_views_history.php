<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostsViewsHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->nullable()->default(null);
            $table->foreign('post_id')->references('id')->on('posts');
            $table->unsignedBigInteger('viewer_id')->nullable()->default(null);
            $table->foreign('viewer_id')->references('id')->on('users');
            $table->string('ip')->nullable()->default(null);
            $table->text('user_agent')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_views');
    }
}
