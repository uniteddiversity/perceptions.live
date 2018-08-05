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


            //Primary Subject Tag
            [
//                'id' => '2',
                'type' => 'pst',
                'value' => 'Festival'
            ],
            [
//                'id' => '2',
                'type' => 'pst',
                'value' => 'Live Music Performance'
            ],
            [
//                'id' => '2',
                'type' => 'pst',
                'value' => 'Living Room Creativity Salons'
            ],


            //Secondary Subject Tag
            [
//                'id' => '2',
                'type' => 'sst',
                'value' => 'test1'
            ],
            [
//                'id' => '2',
                'type' => 'sst',
                'value' => 'test2'
            ]
        ]);
    }
}
