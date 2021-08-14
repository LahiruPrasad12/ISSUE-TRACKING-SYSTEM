<?php

namespace Database\Factories;

use App\Models\Issue_Categories;
use Illuminate\Database\Eloquent\Factories\Factory;

class Issue_CategoriesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Issue_Categories::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cat_id' => rand(1,10),
            'issue_id' => rand(1,10)
        ];
    }
}
