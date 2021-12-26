<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            array(
            'name' => "Admin",
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            
            ),
            array(
            'name' => "Sumit",
            'email' => 'sumit@gmail.com',
            'password' => bcrypt('Password'),
            )
            ));
    }
}
