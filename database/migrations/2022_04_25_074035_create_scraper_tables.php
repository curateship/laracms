<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScraperTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scrapers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('default_url', 1023);
            $table->boolean('direction')->default(0);
            $table->string('item_url', 255);
            $table->string('title', 255);
            $table->string('image', 255);
            $table->string('video', 255);
            $table->string('artist', 255)->nullable();
            $table->string('origins', 255)->nullable();
            $table->string('character', 255)->nullable();
            $table->string('media', 255)->nullable();
            $table->string('misc', 255)->nullable();
            $table->string('status', 10)->default('stopped');
            $table->timestamps();
        });

        Schema::create('scraper_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scraper_id')->nullable()->default(null);
            $table->foreign('scraper_id')->references('id')->on('scrapers');
            $table->string('list_page_url', 1023);
            $table->string('item_url', 1023)->nullable();
            $table->timestamps();
        });

        Schema::create('scraper_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scraper_id')->nullable()->default(null);
            $table->foreign('scraper_id')->references('id')->on('scrapers');
            $table->string('url', 1023);
            $table->text('report');
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
        Schema::dropIfExists('scraper_logs');
        Schema::dropIfExists('scraper_stats');
        Schema::dropIfExists('scrapers');
    }
}
