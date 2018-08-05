<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user_status')->truncate();
        DB::table('user_status')->insert([
            [
                'id'      =>  '1',
                'name'    =>  'Active',
                'slug'    =>  'Active'
            ],
            [
                'id'      =>  '2',
                'name'    =>  'Inactive',
                'slug'    =>  'Inactive',
            ],
            [
                'id'      =>  '3',
                'name'    =>  'Deleted',
                'slug'    =>  'Deleted'
            ]
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
