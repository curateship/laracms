<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('posts_galleries');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('galleries_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->nullable()->default(null);
            $table->foreign('post_id')->references('id')->on('posts');
            $table->string('original');
            $table->string('medium');
            $table->string('thumbnail');
            $table->timestamps();
        });
    }
}
