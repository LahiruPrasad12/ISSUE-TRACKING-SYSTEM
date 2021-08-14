<?php

namespace Database\Factories;

use App\Models\Issue_Subcategories;
use Illuminate\Database\Eloquent\Factories\Factory;

class Issue_SubcategoriesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Issue_Subcategories::class;

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
