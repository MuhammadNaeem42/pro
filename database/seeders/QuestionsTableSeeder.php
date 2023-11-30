<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('questions')->delete();
        
        \DB::table('questions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Imwe mu nteruro zikurikira NTABWO ivuga ukuri.',
                'title_en' => 'One of the following statements is FALSE: ',
                'category' => 1,
                'created_at' => '2022-04-11 02:54:00',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 4,
                'title' => 'Imwe mu nteruro zikurikira ivuga ukuri. ',
                'title_en' => 'One of the following statements is TRUE: ',
                'category' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 5,
                'title' => 'Ibi bikurikira byose byatuma ugira amakenga ko ubucuti/urukundo byanyu biri mukaga uretse kimwe: ',
                'title_en' => 'All the following can alarm that your relationship/friendship is in trouble except one:',
                'category' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}