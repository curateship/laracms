<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\TagsCategories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagsCategoriesSeeder extends Seeder
{
    public function run()
    {
        $cats = [
            'origins', 'media', 'characters', 'artists', 'misc'
        ];

        foreach($cats as $cat){
            $tags_category = new TagsCategories();
            $tags_category->name = $cat;
            $tags_category->save();
        }
    }
}
