<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Imagick;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = User::class;

    public function definition()
    {

        // Generate avatar images;
        $file_name = Str::random(27);
        $path = '/public'.config('images.users_storage_path');
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
        $image->writeImages("$media_path$path/original/$file_name-cover.png", true);

        $for_factory_updates['original'] = "/original/$file_name.png";
        $for_factory_updates['cover-original'] = "/original/$file_name-cover.png";

        foreach($media as $type){
            if($type == 'original'){
                continue;
            }
            $type_config = config("images.$type");

            $image = new Imagick();
            $image->newPseudoImage($type_config['width'], $type_config['height'], "radial-gradient:$color_1-$color_2");
            $image->writeImages("$media_path$path/$type/$file_name.png", true);
            $image->writeImages("$media_path$path/$type/$file_name-cover.png", true);

            $for_factory_updates[$type] = "/$type/$file_name.png";
            $for_factory_updates['cover-'.$type] = "/$type/$file_name-cover.png";
        }

        return [
            'username' => $this->faker->unique()->word(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'status' => 'active',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'original' => $for_factory_updates['original'],
            'medium' => $for_factory_updates['medium'],
            'thumbnail' => $for_factory_updates['thumbnail'],
            'cover_original' => $for_factory_updates['cover-original'],
            'cover_medium' => $for_factory_updates['cover-medium'],
            'cover_thumbnail' => $for_factory_updates['cover-thumbnail'],
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
