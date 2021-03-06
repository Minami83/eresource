<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Jurnal;
use App\Pretest;
use App\Posttest;
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
        $role_student = Role::where('name', 'partisipan')->first();
        $role_admin = Role::where('name', 'admin')->first();
        $role_pustakawan = Role::where('name','pustakawan')->first();
        $jurnal = Jurnal::get();
        $pretest_quest = Pretest::get();
        $posttest_quest = Posttest::get();

        $student = new User();
        $student->id_number = '05111540000001';
        $student->name = 'Budi';
        $student->faculty = 'FAKULTAS TEKNOLOGI INFORMASI DAN KOMUNIKASI';
        $student->department = 'Informatika';
        $student->phone = '087854856373';
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
            $student->pretests()->attach($quest, ['answer' => 'Dummy choice 1.1']);
        }

        $admin = new User();
        $admin->id_number = '05111540000010';
        $admin->name = 'Badu';
        $admin->faculty = 'FAKULTAS TEKNOLOGI INFORMASI DAN KOMUNIKASI';
        $admin->department = 'Informatika';
        $admin->phone = '089645015618';
        $admin->email = 'badu@gmail.com';
        $admin->password = bcrypt('badubadu');
        $admin->progress = 20;
        $admin->verified = 2;
        $admin->save();
        $admin->roles()->attach($role_admin);
        foreach($jurnal as $jur){
            $admin->jurnals()->attach($jur,['completed' => 1]);
        }
        foreach($pretest_quest as $quest){
            $admin->pretests()->attach($quest, ['answer' => 'Dummy choice 1.1']);
        }
        foreach($posttest_quest as $quest){
            $admin->posttests()->attach($quest, ['answer' => 'Dummy choice 1.1']);
        }

        $pustakawan = new User();
        $pustakawan->id_number = '05111540000100';
        $pustakawan->name = 'Badi';
        $pustakawan->faculty = 'FAKULTAS TEKNOLOGI INFORMASI DAN KOMUNIKASI';
        $pustakawan->department = 'Informatika';
        $pustakawan->phone = '081255680241';
        $pustakawan->email = 'badi@gmail.com';
        $pustakawan->password = bcrypt('badibadi');
        $pustakawan->progress = 20;
        $pustakawan->verified = 2;
        $pustakawan->save();
        $pustakawan->roles()->attach($role_pustakawan);
        foreach($jurnal as $jur){
            $pustakawan->jurnals()->attach($jur,['completed' => 1]);
        }
        foreach($pretest_quest as $quest){
            $pustakawan->pretests()->attach($quest, ['answer' => 'Dummy choice 1.1']);
        }
        foreach($posttest_quest as $quest){
            $pustakawan->posttests()->attach($quest, ['answer' => 'Dummy choice 1.1']);
        }

    }
}
