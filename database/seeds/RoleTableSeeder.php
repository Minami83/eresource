<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      $role_student = new Role();
      $role_student->name = 'partisipan';
      $role_student->save();

      $role_admin = new Role();
      $role_admin->name = 'admin';
      $role_admin->save();

      $role_pustakawan = new Role();
      $role_pustakawan->name = 'pustakawan';
      $role_pustakawan->save();
    }
}
