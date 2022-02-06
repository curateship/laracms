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
        $fake_images = [
            '1.jpg',
            '2.jpg',
            '3.jpg',
            '4.jpg',
            '5.jpg',
            '6.jpg',
            '7.jpg',
            '8.jpg',
            '9.jpg',
            '10.jpg',
        ];

        return [
            'name' => $this->faker->word(),
            'extension' => 'jpg',
            'path' => 'images/' . $this->faker->randomElement($fake_images)
        ];
    }
}
