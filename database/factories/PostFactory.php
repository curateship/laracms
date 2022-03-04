<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Imagick;
use Illuminate\Console\Command;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        dump('Seeding new post...');

        // Generate image;
        $file_name = Str::random(27);
        $path = '/public'.config('images.posts_storage_path');
        $media_path = storage_path() . "/app";

        $media = [
            'original', 'medium', 'thumbnail'
        ];

        foreach($media as $type){
            File::ensureDirectoryExists($media_path . $path.'/'.$type);
        }


        $colors = ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet'];
        $color_1 = $colors[rand(0, round(count($colors) / 2 ))];
        $color_2 = $colors[rand(round(count($colors) / 2 ), count($colors)-1)];

        $image = new Imagick();
        $image->newPseudoImage(1024, 768, "radial-gradient:$color_1-$color_2");
        $image->writeImages("$media_path$path/original/$file_name.png", true);

        foreach($media as $type){
            if($type == 'original'){
                continue;
            }
            $type_config = config("images.$type");

            $image = new Imagick();
            $image->newPseudoImage($type_config['width'], $type_config['height'], "radial-gradient:$color_1-$color_2");
            $image->writeImages("$media_path$path/$type/$file_name.png", true);
        }

        dump('New post successfully added.');

        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->unique()->slug(),
            'body' => '{"time":1645388269659,"blocks":[{"id":"0JuQqZUtap","type":"paragraph","data":{"text":"<b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry."}},{"id":"PwYPcaIhrm","type":"paragraph","data":{"text":"<b>Lorem Ipsum</b> has been the industry`s standard dummy text ever since the <b>1500s</b>, when an unknown printer took a galley of type and scrambled it to make a type specimen book."}},{"id":"Ns7mK-QUpp","type":"paragraph","data":{"text":"It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged."}},{"id":"6gayfkxOJU","type":"paragraph","data":{"text":"It was popularised in the <b>1960s</b> with the release of Letraset sheets containing <b>Lorem Ipsum</b> passages, and more recently with desktop publishing software like Aldus PageMaker including versions of <b>Lorem Ipsum</b>."}}],"version":"2.23.2"}',
            'user_id' => User::factory(),
            'original' => "/original/$file_name.png",
            'medium' => "/medium/$file_name.png",
            'thumbnail' => "/thumbnail/$file_name.png",
            'category_id' => Category::all()->random()->id,
        ];
    }
}
