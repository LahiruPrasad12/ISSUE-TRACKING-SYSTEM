<?php

namespace Database\Seeders;

use App\Models\Issues;
use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Issues::factory()->times(10)->create();
    }
}
