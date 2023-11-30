<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuestionCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('question_categories')->delete();
        
        \DB::table('question_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Umutuku',
                'name_en' => 'Red',
                'color_code' => '#c1272d',
                'desciption' => NULL,
                'desciption_en' => NULL,
                'created_at' => '2022-04-11 02:28:20',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Umuhondo',
                'name_en' => 'Yellow',
                'color_code' => '#efd806',
                'desciption' => NULL,
                'desciption_en' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Ubururu',
                'name_en' => 'Blue',
                'color_code' => '#1853e5',
                'desciption' => NULL,
                'desciption_en' => NULL,
                'created_at' => '2022-04-11 02:31:33',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Icyatsi',
                'name_en' => 'Green',
                'color_code' => '#43e518',
                'desciption' => NULL,
                'desciption_en' => NULL,
                'created_at' => '2022-04-11 02:31:33',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}