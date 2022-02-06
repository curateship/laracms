<?php

namespace Database\Seeders;

use App;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RoleUserSeeder::class);

        // Same as above except without separate seed file
        $users = App\Models\User::factory(10)->create();
        foreach ($users as $user) {
            $user->image()->save( \App\Models\Image::factory()->make() );
        }

        \App\Models\Category::factory(10)->create();
        $posts = \App\Models\Post::factory(10)->create();
        \App\Models\Post::factory(10)->create();
        \App\Models\Comment::factory(10)->create();
        \App\Models\Tag::factory(10)->create();

        foreach($posts as $post)
        {
            $tags_ids = [];
            $tags_ids[] = \App\Models\Tag::all()->random()->id;
            $tags_ids[] = \App\Models\Tag::all()->random()->id;
            $tags_ids[] = \App\Models\Tag::all()->random()->id;
            $post->image()->save( \App\Models\Image::factory()->make() );
            $post->tags()->sync( $tags_ids );
            
        }
    }
}