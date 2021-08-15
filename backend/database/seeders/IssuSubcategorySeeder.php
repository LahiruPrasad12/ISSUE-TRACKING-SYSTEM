<?php

namespace Database\Seeders;

use App\Models\Issue_Subcategories;
use Illuminate\Database\Seeder;

class IssuSubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Issue_Subcategories::factory()->times(50)->create();
    }
}
