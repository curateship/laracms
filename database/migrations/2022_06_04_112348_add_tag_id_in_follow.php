<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTagIdInFollow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('follows', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('follow_tag_id')->nullable()->default(null);
            $table->foreign('follow_tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('follows', function (Blueprint $table) {
            //
            $table->dropForeign('follows_follow_tag_id_foreign');
            $table->dropColumn('follow_tag_id');
        });
    }
}
