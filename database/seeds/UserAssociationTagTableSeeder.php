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
        DB::table('user_sorting_tags')->truncate();
        DB::table('user_sorting_tags')->insert([
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
            ],
            [
                'id' => '4',
                'name' => 'Audience Only',
                'slug' => 'role'
            ],
            [
                'id' => '5',
                'name' => 'Ideas',
                'slug' => 'role'
            ],
            [
                'id' => '6',
                'name' => 'Video',
                'slug' => 'role'
            ],
            [
                'id' => '7',
                'name' => 'Photos',
                'slug' => 'role'
            ],
            [
                'id' => '8',
                'name' => 'Music & Sampling',
                'slug' => 'role'
            ],
            [
                'id' => '9',
                'name' => 'Video Editing',
                'slug' => 'role'
            ],
            [
                'id' => '10',
                'name' => 'Music/Audio Production',
                'slug' => 'role'
            ],
            [
                'id' => '11',
                'name' => 'Donor',
                'slug' => 'role'
            ]
        ]);
    }
}
