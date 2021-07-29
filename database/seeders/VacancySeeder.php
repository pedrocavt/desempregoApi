<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vacancies')->insert([
            'title' => 'Programdor PHP l',
            'description' => 'Programdor php para trabalhar na TRAY',
            'wage' => 3500,
            'category_id' => 1,
            'user_id' => 1
        ]);
    }
}
