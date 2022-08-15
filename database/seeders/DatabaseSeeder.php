<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\Like;
use App\Models\Post;
use App\Models\Role;
use App\Models\Scraper;
use App\Models\ScraperLog;
use App\Models\Tag;
use App\Models\TagsCategories;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Role::truncate();
        Category::truncate();
        Post::truncate();
        Comment::truncate();
        TagsCategories::truncate();
        Tag::truncate();
        Scraper::truncate();
        Follow::truncate();
        ScraperLog::truncate();
        Like::truncate();
        DB::table('posts_videos')->delete();
        DB::table('posts_views')->delete();
        DB::table('role_user')->delete();

        Schema::enableForeignKeyConstraints();
        $this->call(RoleSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(UserSeeder::class);
        Post::factory(20)->create();
        Comment::factory(10)->create();
        $this->call(TagsCategoriesSeeder::class);
        Tag::factory(10)->create();
        $this->call(PostTagsSeeder::class);
        $this->call(ScraperSeeder::class);
    }
}
