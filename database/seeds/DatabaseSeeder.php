<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(JurnalTableSeeder::class);
        $this->call(PretestTableSeeder::class);
        $this->call(PosttestTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
