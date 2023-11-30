<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('answers')->delete();
        
        \DB::table('answers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'question_option' => 3,
                'explanation' => 'Umwangavu/umugore ashobora gusama igihe cyose akoze imibonano mpuzabitsina idakingiye, nubwo byaba ari ku nshuro ya mbere. Ibinini byo kuboneza urubyaro byizewe ku kigero cya 99% iyo bikoreshejwe buri munsi nta gusiba. Indwara zandurira mu mibonano mpuzabistina zishobora no kwandura mu buryo bwinshi butandukanye harimo gusomana, mu gihe cyo kubyara, n’isuku nke. SIDA ni indwara yandurira mu mibonano mpuzabitsina kandi yakwandura no mu bundi buryo',
                'explanation_en' => 'A girl can become pregnant any time she has unprotected sex, including the first time. A contraceptive pill is 99% effective if it is used correctly every day without skipping any day. STIs do not necessarily spread through sex. They can be spread through intimate skin to skin contact such as kissing, during delivery and poor hygiene. HIV is an STI and can spread without sex.',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}