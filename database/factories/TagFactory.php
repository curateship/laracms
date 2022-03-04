<?php

namespace Database\Factories;

use App\Models\TagsCategories;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
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
            'category_id' => TagsCategories::all()->random()->id
        ];
    }
}
