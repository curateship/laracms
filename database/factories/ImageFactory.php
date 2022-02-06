<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'extension' => 'jpg',
            'path' => '/public/images/' . $this->faker->word() . '.' . 'jpg',
        ];
    }
}
