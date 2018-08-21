<?php

use Illuminate\Database\Seeder;

class SortingTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
//        DB::table('sorting_tags')->truncate();
        DB::table('sorting_tags')->insert([
            [
                'id' => '1',
                'tag' => 'Opportunity',
                'tag_color' => '',
                'description' => '',
                'created_by' => '0',
                'group_id' => '0',
                'status' => '1',
                'tag_for' => 'contents',
                'not_selectable' => '1'
            ],
            [
                'id' => '2',
                'tag' => 'Service',
                'tag_color' => '',
                'description' => '',
                'created_by' => '0',
                'group_id' => '0',
                'status' => '1',
                'tag_for' => 'contents',
                'not_selectable' => '1'
            ],


            ///greater community intention tags
            [
                'id' => '3',
                'tag' => 'Coming Together',
                'tag_color' => '#33ffd4',
                'description' => '',
                'created_by' => '0',
                'group_id' => '0',
                'status' => '1',
                'tag_for' => 'gci',
                'not_selectable' => '1'
            ],
            [
                'id' => '4',
                'tag' => 'Artists & Musicians',
                'tag_color' => '#008000',
                'description' => '',
                'created_by' => '0',
                'group_id' => '0',
                'status' => '1',
                'tag_for' => 'gci',
                'not_selectable' => '1'
            ],
            [
                'id' => '5',
                'tag' => 'Co-Creation',
                'tag_color' => '#fcf3cf',
                'description' => '',
                'created_by' => '0',
                'group_id' => '0',
                'status' => '1',
                'tag_for' => 'gci',
                'not_selectable' => '1'
            ],
            [
                'id' => '6',
                'tag' => 'Travel & Adventure',
                'tag_color' => ' #ec7063',
                'description' => '',
                'created_by' => '0',
                'group_id' => '0',
                'status' => '1',
                'tag_for' => 'gci',
                'not_selectable' => '1'
            ],
            [
                'id' => '7',
                'tag' => 'Sharing & Experiencing',
                'tag_color' => '#f2f4f4',
                'description' => '',
                'created_by' => '0',
                'group_id' => '0',
                'status' => '1',
                'tag_for' => 'gci',
                'not_selectable' => '1'
            ],
            [
                'id' => '8',
                'tag' => 'Reprogramming & Transformation',
                'tag_color' => '#ca6f1e',
                'description' => '',
                'created_by' => '0',
                'group_id' => '0',
                'status' => '1',
                'tag_for' => 'gci',
                'not_selectable' => '1'
            ],
            [
                'id' => '9',
                'tag' => 'Party & Celebration',
                'tag_color' => '#0b5345',
                'description' => '',
                'created_by' => '0',
                'group_id' => '0',
                'status' => '1',
                'tag_for' => 'gci',
                'not_selectable' => '1'
            ],
            [
                'id' => '10',
                'tag' => 'Permaculture',
                'tag_color' => '#1c2833',
                'description' => '',
                'created_by' => '0',
                'group_id' => '0',
                'status' => '1',
                'tag_for' => 'gci',
                'not_selectable' => '1'
            ],
            [
                'id' => '11',
                'tag' => 'Supportive Economies',
                'tag_color' => '#8e44ad',
                'description' => '',
                'created_by' => '0',
                'group_id' => '0',
                'status' => '1',
                'tag_for' => 'gci',
                'not_selectable' => '1'
            ]
        ]);
    }
}
