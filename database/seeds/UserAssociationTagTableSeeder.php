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
                'slug' => 'vd-p',
                'icon' => ''
            ],
            [
                'id' => '2',
                'name' => 'Onscreen',
                'slug' => 'on-s',
                'icon' => ''
            ],
            [
                'id' => '3',
                'name' => 'Co-Creators',
                'slug' => 'co-cr',
                'icon' => ''
            ],
            [
                'id' => '4',
                'name' => 'Audience Only',
                'slug' => 'role',
                'icon' => 'fa-streetview'
            ],
            [
                'id' => '5',
                'name' => 'Ideas',
                'slug' => 'role',
                'icon' => 'fa-lightbulb-o'
            ],
            [
                'id' => '6',
                'name' => 'Videos',
                'slug' => 'role',
                'icon' => 'fa-video-camera'
            ],
            [
                'id' => '7',
                'name' => 'Photos',
                'slug' => 'role',
                'icon' => 'fa-file-image-o'
            ],
            [
                'id' => '8',
                'name' => 'Music & Sampling',
                'slug' => 'role',
                'icon' => 'fa-file-audio-o'
            ],
            [
                'id' => '9',
                'name' => 'Video Editing',
                'slug' => 'role',
                'icon' => 'fa-film'
            ],
            [
                'id' => '10',
                'name' => 'Music/Audio Production',
                'slug' => 'role',
                'icon' => 'fa-music'
            ],
            [
                'id' => '11',
                'name' => 'Donor',
                'slug' => 'role',
                'icon' => 'fa-money'
            ]
        ]);
    }
}
