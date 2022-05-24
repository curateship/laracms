<?php

namespace Database\Seeders;

use App\Models\TagsCategories;
use Illuminate\Database\Seeder;

class ScraperTagsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $cats = ['origins', 'media', 'characters', 'artists', 'misc'];
        foreach($cats as $name){
            $cat = new TagsCategories();
            $cat->name = $name;
            $cat->save();
        }
    }
}
