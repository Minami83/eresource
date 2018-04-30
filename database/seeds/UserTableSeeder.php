<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
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

        $student = new User();
        $student->nrp = '51151000555';
        $student->name = 'Budi';
        $student->faculty = 'Fakultas Teknologi Informasi dan Komunikasi';
        $student->department = 'Informatika';
        $student->phone = '08122467882';
        $student->email = 'budi@gmail.com';
        $student->password = bcrypt('budibudi');
        $student->progress = 4;
        $student->verified = True;
        $student->save();
        $student->roles()->attach($role_student);

        $admin = new User();
        $admin->nrp = '51151000556';
        $admin->name = 'Badu';
        $admin->faculty = 'Fakultas Teknologi Informasi dan Komunikasi';
        $admin->department = 'Informatika';
        $admin->phone = '08122446882';
        $admin->email = 'badu@gmail.com';
        $admin->password = bcrypt('badubadu');
        $admin->progress = 20;
        $admin->verified = True;
        $admin->save();
        $admin->roles()->attach($role_admin);


    }
}
