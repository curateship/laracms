<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('original')->nullable()->default(null);
            $table->string('thumbnail')->nullable()->default(null);
            $table->string('medium')->nullable()->default(null);
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('favorites_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('favorite_id')->nullable()->default(null);
            $table->foreign('favorite_id')->references('id')->on('favorites');
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
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('favorites_items');
    }
}
