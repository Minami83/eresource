<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Log;
use Carbon\Carbon;

class DelUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:delUser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete User that hasnt login for long time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $users = User::get();
        foreach($users as $user){
            // dd($user->id);
            $lastLog = Log::where('user_id',$user->id)->orderBy('created_at','desc')->first();
            $exp = $lastLog->created_at->modify('+90 day')->format('y-m-d');
            $now = Carbon::now()->format('y-m-d');
            // dd($exp < $now);
            // dd(Carbon::now()->format('y-m-d'));
            // dd($lastLog->created_at->modify('+90 day')->format('y-m-d'));
            if($lastLog==null or $exp < $now)
                $user->delete();
        }
        echo('done');
    }
}
