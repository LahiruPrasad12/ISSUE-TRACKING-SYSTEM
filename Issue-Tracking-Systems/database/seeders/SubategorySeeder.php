<?php

namespace Database\Seeders;

use App\Models\Subcategories;
use Illuminate\Database\Seeder;

class SubategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subcategories::factory()->times(10)->create();
    }
}
