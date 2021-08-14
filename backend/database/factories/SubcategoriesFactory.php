<?php

namespace Database\Factories;

use App\Models\Subcategories;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubcategoriesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subcategories::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->text(15),
            'description'=>$this->faker->text(50),
            'cat_ID' => rand(1,10),
        ];
    }
}
