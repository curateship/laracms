<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixAddContestPlaceForPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
            $table->integer('contest_place')->nullable()->default(null);
        });

        Schema::table('follows', function (Blueprint $table) {
            //
            $table->dropColumn('contest_place');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
            $table->dropColumn('contest_place');
        });

        Schema::table('follows', function (Blueprint $table) {
            //
            $table->integer('contest_place')->nullable()->default(null);
        });
    }
}
