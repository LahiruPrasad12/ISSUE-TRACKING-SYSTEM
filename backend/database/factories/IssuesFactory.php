<?php

namespace Database\Factories;

use App\Models\Issues;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class IssuesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Issues::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->text(30);
        return [
            'title'=>$title,
            'body'=>$this->faker->text(100),
            'uuid' => rand(1,50),
            'slug'=>Str::slug($title)
        ];
    }
}
