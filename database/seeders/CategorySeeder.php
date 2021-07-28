<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'category' => 'Junior'
        ]);

        DB::table('categories')->insert([
            'category' => 'Pleno'
        ]);

        DB::table('categories')->insert([
            'category' => 'Senior'
        ]);
    }
}
