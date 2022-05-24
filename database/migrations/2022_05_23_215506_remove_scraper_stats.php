<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveScraperStats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('scraper_stats');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scraper_stats', function (Blueprint $table) {
            Schema::create('scraper_stats', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('scraper_id')->nullable()->default(null);
                $table->foreign('scraper_id')->references('id')->on('scrapers');
                $table->string('list_page_url', 1023);
                $table->string('item_url', 1023)->nullable();
                $table->timestamps();
            });
        });
    }
}
