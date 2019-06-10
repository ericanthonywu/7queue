<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            "username"=>"superadmin",
            "email"=>"superadmin@email.com",
            "name"=>"superadmin",
            "level"=>3,
            "status"=>0,
            "password"=>bcrypt('admin'),
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
