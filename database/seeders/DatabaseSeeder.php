<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\Tag;
use App\Models\TagsCategories;
use App\Models\User;
use Illuminate\Database\Seeder;
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

        Schema::enableForeignKeyConstraints();
        $this->call(RoleSeeder::class);
        $this->call(RoleUserSeeder::class);
        Category::factory(10)->create();
        Post::factory(20)->create();
        Comment::factory(10)->create();
        TagsCategories::factory(5)->create();
        Tag::factory(10)->create();
        $this->call(PostTagsSeeder::class);
    }
}
