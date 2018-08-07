<?php

use Illuminate\Database\Seeder;

class UserAssociationTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user_association_tags')->truncate();
        DB::table('user_association_tags')->insert([
            [
                'id' => '1',
                'name' => 'Video Producer',
                'slug' => 'vd-p'
            ],
            [
                'id' => '2',
                'name' => 'Onscreen',
                'slug' => 'on-s'
            ],
            [
                'id' => '3',
                'name' => 'Co-Creators',
                'slug' => 'co-cr'
            ]
        ]);
    }
}
