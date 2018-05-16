<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Jurnal;
use App\Pretest;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role_student = Role::where('name', 'student')->first();
        $role_admin = Role::where('name', 'admin')->first();
        $jurnal = Jurnal::get();
        $pretest_quest = Pretest::get();

        $student = new User();
        $student->nrp = '51151000555';
        $student->name = 'Budi';
        $student->faculty = 'Fakultas Teknologi Informasi dan Komunikasi';
        $student->department = 'Informatika';
        $student->phone = '08122467882';
        $student->email = 'budi@gmail.com';
        $student->password = bcrypt('budibudi');
        $student->progress = 4;
        $student->verified = 1; //0-> not verified, 1->verified, 2->complete course
        $student->save();
        $student->roles()->attach($role_student);
        foreach($jurnal as $jur){
            if($jur->id<=4) $comp = 1;
            else $comp = 0;
            $student->jurnals()->attach($jur,['completed' => $comp]);
        }
        foreach($pretest_quest as $quest){
            $student->pretests()->attach($quest, ['answer' => 1]);
        }

        $admin = new User();
        $admin->nrp = '51151000556';
        $admin->name = 'Badu';
        $admin->faculty = 'Fakultas Teknologi Informasi dan Komunikasi';
        $admin->department = 'Informatika';
        $admin->phone = '08122446882';
        $admin->email = 'badu@gmail.com';
        $admin->password = bcrypt('badubadu');
        $admin->progress = 20;
        $admin->verified = 2;
        $admin->save();
        $admin->roles()->attach($role_admin);
        foreach($jurnal as $jur){
            $admin->jurnals()->attach($jur,['completed' => 1]);
        }

    }
}
