<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $post_category = new Category();
        $post_category->name = 'Post';
        $post_category->slug = Str::slug('Post');
        $post_category->save();

        $post_category = new Category();
        $post_category->name = 'Premium';
        $post_category->slug = Str::slug('Premium');
        $post_category->save();
    }
}
