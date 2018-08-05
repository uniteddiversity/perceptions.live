<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::table('categories')->insert([
            [
                'id' => '1',
                'name' => 'Creative'
            ],
            [
                'id' => '2',
                'name' => 'Social'
            ],
            [
                'id' => '3',
                'name' => 'Lifestyle'
            ],
            [
                'id' => '4',
                'name' => 'Environmental'
            ]
        ]);
    }
}
