<?php

use Illuminate\Database\Seeder;

class ContentAccessLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('content_access_levels')->truncate();
        DB::table('content_access_levels')->insert([
            [
                'id' => '1',
                'name' => 'Public',
                'slug' => 'public'
            ],
            [
                'id' => '2',
                'name' => 'Only Logged',
                'slug' => 'only-logged'
            ],
            [
                'id' => '3',
                'name' => 'Private',
                'slug' => 'private'
            ]
        ]);
    }
}
