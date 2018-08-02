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
                'name' => 'admin',
                'slug' => 'admin'
            ],
            [
                'id' => '4',
                'name' => 'user',
                'slug' => 'user'
            ]
        ]);
    }
}
