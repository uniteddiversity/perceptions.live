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
                'not_selectable' => '1'
            ],
        ]);
    }
}
