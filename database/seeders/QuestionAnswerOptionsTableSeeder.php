<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuestionAnswerOptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('question_answer_options')->delete();
        
        \DB::table('question_answer_options')->insert(array (
            0 => 
            array (
                'id' => 1,
                'index' => 'A',
                'title' => 'Umwangavu ashobora gusama nubwo yaba akoze imibonano mpuzabitsina idakingiye ku nshuro ya mbere. ',
                'title_en' => 'A woman can get pregnant even the first time she has sex.',
                'question' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'index' => 'B',
                'title' => 'Umugore/umukobwa mu gihe afata ibinini byo kuboneza urubyaro, ntabwo agomba kumara umunsi n’umwe atanywa ibyo binini.
',
                'title_en' => 'If a woman is taking contraceptive pills, it is not acceptable for her to spend few days without taking a pill.  
',
                'question' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'index' => 'C',
                'title' => 'Ntushobora kwandura indwara zandurira mu mibonano mpuzabitsina mu gihe utakoze imibonano mpuzabitsina.',
            'title_en' => 'You can’t get a sexually transmitted infection (STI) if you do not have sexual intercourse.
',
                'question' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'index' => 'D',
                'title' => 'B and C',
                'title_en' => 'B and C',
                'question' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}