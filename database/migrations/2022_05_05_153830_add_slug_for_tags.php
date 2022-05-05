<?php

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AddSlugForTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            //
            $table->string('slug')->nullable()->default(null);
        });

        // Add slugs for exist tags;
        $tags = Tag::whereNull('slug')
            ->get();

        foreach($tags as $tag){
            $slug = Str::slug($tag->name, '-');
            $exist = Tag::where('slug', 'like', $slug . '%')
                ->get();

            if (count($exist) > 0) {
                $slug = Post::getNewSlug($slug, $exist);
            }

            $tag->slug = $slug;
            $tag->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tags', function (Blueprint $table) {
            //
            $table->dropColumn('slug');
        });
    }
}
