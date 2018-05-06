<?php

use Illuminate\Database\Seeder;
use App\Pretest;
class PretestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $pretest = new Pretest();
        $pretest->question = 'Dummy question 1';
        $pretest->choice_1 = 'Dummy choice 1.1';
        $pretest->choice_2 = 'Dummy choice 1.2';
        $pretest->choice_3 = 'Dummy choice 1.3';
        $pretest->choice_4 = 'Dummy choice 1.4';
        $pretest->save();

        $pretest = new Pretest();
        $pretest->question = 'Dummy question 2';
        $pretest->choice_1 = 'Dummy choice 2.1';
        $pretest->choice_2 = 'Dummy choice 2.2';
        $pretest->choice_3 = 'Dummy choice 2.3';
        $pretest->choice_4 = 'Dummy choice 2.4';
        $pretest->save();
    }
}
