<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('languages')->insert([
            [
                'code'          =>  'en',
                'language'      =>  'English'
            ],
            [
                'code'          =>  'nl',
                'language'      =>  'Dutch'
            ],
            [
                'code'          =>  'he',
                'language'      =>  'Hebrew'
            ],
            [
                'code'          =>  'de',
                'language'      =>  'German'
            ],
//            [
//                'code'          =>  'fi',
//                'language'      =>  'Finnish'
//            ],
            [
                'code'          =>  'es',
                'language'      =>  'Spanish'
            ],
            [
                'code'          =>  'fr',
                'language'      =>  'French'
            ],
            [
                'code'          =>  'oo',
                'language'      =>  'Other'
            ],
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
