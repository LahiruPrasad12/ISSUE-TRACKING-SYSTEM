<?php

namespace Database\Seeders;

use App\Models\Issue_Categories;
use Illuminate\Database\Seeder;

class IssuCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Issue_Categories::factory()->times(10)->create();
    }
}
