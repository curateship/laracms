<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTagsSeeder extends Seeder
{
    public function run()
    {
        DB::table('post_tag')->delete();
        foreach(Post::all() as $post)
        {
            $tags = [];
            for($i = 1 ; $i <= rand(3, 10) ; $i++){
                $tags[] = Tag::all()->random()->id;
            }

            $tags = array_unique($tags);
            foreach($tags as $tag_id){
                DB::table('post_tag')
                    ->insert([
                        'post_id' => $post->id,
                        'tag_id' => $tag_id
                    ]);
            }
        }
    }
}
