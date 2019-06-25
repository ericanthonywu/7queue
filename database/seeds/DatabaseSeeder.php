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
            "nickname"=>"superadmin",
            "level"=>3,
            "status"=>0,
            "password"=>bcrypt('admin'),
        ]);
        DB::table('manager')->insert([
            "username"=>"manager",
            "email"=>"manager@email.com",
            "nickname"=>"manager",
            "status"=>0,
            "email_st"=>1,
            "password"=>bcrypt('manager'),
            "created_at"=>"2019-04-26 10:10:10"
        ]);
        DB::table('kategori_produk')->insert([
            "kategori"=>"Makanan",
        ]);
        DB::table('kategori_produk')->insert([
            "kategori"=>"Minuman",
        ]);
        DB::table('kategori_produk')->insert([
            "kategori"=>"Sampah",
        ]);
        DB::table('users')->insert([
            "nickname"=>"tes",
            "email"=>"tes@gmail.com",
            "email_st"=>1,
            "password"=>bcrypt('tes'),
            "gender"=>"male",
            'foto_profil'=>'WKNyqCrzoARf1k3KKsokIP66pzzqBFRVA3TZfDqzCigcSrUh4ly21S5dHcFIhbrd55sTvF38VBfrYQBlBw7eVn61IVxWVNrNgPRI1561022685.jpg'
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
