<?php

use Illuminate\Database\Seeder;
use App\Posttest;
class PosttestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      $posttest = new Posttest();
      $posttest->question = 'Dummy question 1';
      $posttest->choice_1 = 'Dummy choice 1.1';
      $posttest->choice_2 = 'Dummy choice 1.2';
      $posttest->choice_3 = 'Dummy choice 1.3';
      $posttest->choice_4 = 'Dummy choice 1.4';
      $posttest->save();

      $posttest = new Posttest();
      $posttest->question = 'Dummy question 2';
      $posttest->choice_1 = 'Dummy choice 2.1';
      $posttest->choice_2 = 'Dummy choice 2.2';
      $posttest->choice_3 = 'Dummy choice 2.3';
      $posttest->choice_4 = 'Dummy choice 2.4';
      $posttest->save();
    }
}
