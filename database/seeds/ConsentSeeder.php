<?php

use Illuminate\Database\Seeder;

class ConsentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('gdpr_treatment')->truncate();
        DB::table('gdpr_treatment')->insert([
            [
                'id' => '1',
                'active' => '1',
                'required' => '1',
                'name' => 'I understand that basic cookies are used to enhance my experience.',
                'documentVersion' => '1',
                'description' => 'By using our site, you consent to cookies being used to enhance your experience.',
                'documentUrl' => 'https://docs.perceptiontravel.tv/legal-docs/terms-of-service',
                'weight' => '1',
                'created_at' => '2020-04-21',
                'updated_at' => '2020-04-21',
            ]
        ]);
    }
}
