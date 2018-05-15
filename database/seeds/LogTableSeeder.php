<?php

use Illuminate\Database\Seeder;
use App\Log;
use App\User;
use Carbon\Carbon;
class LogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      $users = User::get();
      foreach($users as $user){
        $log = new Log();
        $log->user_id = $user->id;
        $log->jurnal_id = 0;
        $log->activity = 'Login';
        $log->created_at = Carbon::now();
        $log->updated_at = Carbon::now();
        $log->save();
      }
    }
}
