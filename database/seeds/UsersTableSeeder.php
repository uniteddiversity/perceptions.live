<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->insert([
            [
                'id'            =>  '1',
                'first_name'    =>  'admin',
                'display_name'     =>  'admin',
//                'username'      =>  'admin',
                'email'         =>  'admin@osm.com',
                'password'      =>  bcrypt('secret'),
                'role_id'       =>  1,
                'status_id'        =>  1
            ]
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
