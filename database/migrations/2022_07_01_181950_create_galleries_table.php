<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('original')->nullable()->default(null);
            $table->string('thumbnail')->nullable()->default(null);
            $table->string('medium')->nullable()->default(null);
            $table->string('status')->nullable()->default('published');
            $table->timestamps();
        });

        Schema::create('galleries_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gallery_id')->nullable()->default(null);
            $table->foreign('gallery_id')->references('id')->on('galleries');
            $table->unsignedBigInteger('post_id')->nullable()->default(null);
            $table->foreign('post_id')->references('id')->on('posts');
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
        Schema::dropIfExists('galleries_posts');
        Schema::dropIfExists('galleries');
    }
}
