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
                'first_name'    =>  'PRCPTION Travel',
                'display_name'     =>  'PRCPTION Travel',
//                'username'      =>  'prcptiontravel',
                'email'         =>  'Jordan@perceptiontravel.tv',
                'password'      =>  bcrypt('~!RhTA7HCd!~'),
                'role_id'       =>  1,
                'status_id'        =>  1
            ]
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
