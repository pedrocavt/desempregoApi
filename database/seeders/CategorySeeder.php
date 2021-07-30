<?php

namespace Database\Seeders;

use App\Support\CategorySupport;
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
        $categories = CategorySupport::getAllCategories();

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'category' => $category
            ]);
        }
    }
}
