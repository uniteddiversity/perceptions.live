<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::table('roles')->insert([
            [
                'id' => '1',
                'name' => 'Admin',
                'slug' => 'admin'
            ],
            [
                'id' => '100',
                'name' => 'Group Admin',
                'slug' => 'group-admin'
            ],
            [
                'id' => '110',
                'name' => 'Group Moderator',
                'slug' => 'group-moderato'
            ],
            [
                'id' => '120',
                'name' => 'User',
                'slug' => 'user'
            ]
        ]);
    }
}
