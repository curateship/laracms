<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoForPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->nullable()->default(null);
            $table->foreign('post_id')->references('id')->on('posts');
            $table->string('original');
            $table->string('medium');
            $table->string('thumbnail');
            $table->timestamps();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->string('type')->nullable()->default('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_videos');

        Schema::table('posts', function (Blueprint $table) {
            //
            $table->dropColumn('type');
        });
    }
}
