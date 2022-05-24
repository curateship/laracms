<?php

namespace Database\Factories;

use App\Models\TagsCategories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Imagick;

class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Generate avatar images;
        $file_name = Str::random(27);
        $path = '/public'.config('images.tags_storage_path');
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

        $for_factory_updates = [];

        $image = new Imagick();
        $image->newPseudoImage(1024, 768, "radial-gradient:$color_1-$color_2");
        $image->writeImages("$media_path$path/original/$file_name.png", true);

        $for_factory_updates['original'] = "/original/$file_name.png";

        foreach($media as $type){
            if($type == 'original'){
                continue;
            }
            $type_config = config("images.$type");

            $image = new Imagick();
            $image->newPseudoImage($type_config['width'], $type_config['height'], "radial-gradient:$color_1-$color_2");
            $image->writeImages("$media_path$path/$type/$file_name.png", true);

            $for_factory_updates[$type] = "/$type/$file_name.png";
        }

        $title = $this->faker->word();

        return [
            'name' => $title,
            'category_id' => TagsCategories::all()->random()->id,
            'original' => $for_factory_updates['original'],
            'medium' => $for_factory_updates['medium'],
            'thumbnail' => $for_factory_updates['thumbnail'],
            'body' => '{"time":1648143854001,"blocks":[{"id":"vijzrMkD7N","type":"paragraph","data":{"text":"<b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry. <b>Lorem Ipsum</b> has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."}}],"version":"2.23.2"}',
            'slug' => Str::slug($title, '-')
        ];
    }
}
