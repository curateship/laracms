<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\Post;
use App\Models\Role;
use App\Models\Scraper;
use App\Models\ScraperLog;
use App\Models\ScraperStat;
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
        ScraperStat::truncate();
        ScraperLog::truncate();
        DB::table('role_user')->delete();


        Schema::enableForeignKeyConstraints();
        $this->call(RoleSeeder::class);
        $this->call(RoleUserSeeder::class);
        Category::factory(10)->create();
        Post::factory(20)->create();
        Comment::factory(10)->create();
        TagsCategories::factory(5)->create();
        Tag::factory(10)->create();
        $this->call(PostTagsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ScraperSeeder::class);
        $this->call(ScraperTagsCategoriesSeeder::class);
    }
}
