<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->default(null);
            $table->foreign('category_id')->references('id')->on('tags_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropForeign('tags_category_id_foreign');
            $table->dropColumn('category_id');
        });

        Schema::dropIfExists('tags_categories');
    }
}
