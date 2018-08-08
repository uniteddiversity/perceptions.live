<?php

use Illuminate\Database\Seeder;

class MetaDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('meta_data')->truncate();
        DB::table('meta_data')->insert([
            [
//                'id' => '1',
                'type' => 'gci',//Grater Community Intention
                'value' => 'Coming Together'
            ],
            [
//                'id' => '2',
                'type' => 'gci',
                'value' => 'Artists & Musicians'
            ],
            [
//                'id' => '2',
                'type' => 'gci',
                'value' => 'Co-Creation'
            ],
            [
//                'id' => '2',
                'type' => 'gci',
                'value' => 'Travel & Adventure'
            ],
            [
//                'id' => '2',
                'type' => 'gci',
                'value' => 'Sharing & Experiencing'
            ],
            [
//                'id' => '2',
                'type' => 'gci',
                'value' => 'Reprogramming & Transformation'
            ],
            [
//                'id' => '2',
                'type' => 'gci',
                'value' => 'Party & Celebration'
            ],
            [
//                'id' => '2',
                'type' => 'gci',
                'value' => 'Permaculture'
            ],
            [
//                'id' => '2',
                'type' => 'gci',
                'value' => 'Supportive Economies'
            ],
            [
//                'id' => '2',
                'type' => 'gci',
                'value' => 'Reprogramming & Transformation'
            ],


            //Content Role s
            [
//                'id' => '100',
                'type' => 'c-role',
                'value' => 'Audience'
            ],
            [
//                'id' => '101',
                'type' => 'c-role',
                'value' => 'Ideas'
            ],
            [
//                'id' => '102',
                'type' => 'c-role',
                'value' => 'Video'
            ],
            [
//                'id' => '103',
                'type' => 'c-role',
                'value' => 'Photos'
            ],
            [
//                'id' => '104',
                'type' => 'c-role',
                'value' => 'Music & Sampling'
            ],
            [
//                'id' => '105',
                'type' => 'c-role',
                'value' => 'Video Editing'
            ],
            [
//                'id' => '106',
                'type' => 'c-role',
                'value' => 'Music/Audio Production'
            ],
            [
//                'id' => '107',
                'type' => 'c-role',
                'value' => 'Donor'
            ],

        ]);
    }
}
