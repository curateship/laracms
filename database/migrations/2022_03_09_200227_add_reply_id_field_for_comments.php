<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReplyIdFieldForComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('reply_id')->nullable()->default(null);
            $table->foreign('reply_id')->references('id')->on('comments');
            $table->text('the_comment')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            //
            $table->dropForeign('comments_reply_id_foreign');
            $table->dropColumn('reply_id');
        });
    }
}
