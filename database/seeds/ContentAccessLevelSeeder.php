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
                'name' => 'Public: Anyone.',
                'slug' => 'public'
            ],
            [
                'id' => '2',
                'name' => 'Logged In: Only members of the PRCPTION network.',
                'slug' => 'only-logged'
            ],
            [
                'id' => '3',
                'name' => 'Private: Only users of a certain group or community.',
                'slug' => 'private'
            ]
        ]);
    }
}
