<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileBoxFieldForUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('cover_original')->nullable()->default(null);
            $table->string('cover_thumbnail')->nullable()->default(null);
            $table->string('cover_medium')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('cover_original');
            $table->dropColumn('cover_thumbnail');
            $table->dropColumn('cover_medium');
        });
    }
}
