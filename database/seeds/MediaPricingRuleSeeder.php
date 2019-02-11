<?php

use Illuminate\Database\Seeder;

class MediaPricingRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('media_package_rules')->insert([
            [
                'id'    =>  '1',
                'package_id'    =>  '0',
                'rule_key'     =>  'prioritize_my_account',
                'rule_description'     =>  'Prioritize My Account',
                'amount'     =>  '500',
                'is_deleted'     =>  '0',
            ],
            [
                'id'    =>  '2',
                'package_id'    =>  '0',
                'rule_key'     =>  'remove_water_mark',
                'rule_description'     =>  'Remove Water Mark',
                'amount'     =>  '200',
                'is_deleted'     =>  '0',
            ],
            [
                'id'    =>  '3',
                'package_id'    =>  '0',
                'rule_key'     =>  'download_video_licence',
                'rule_description'     =>  'Download Video & Licence Rights (10x in 5 years)',
                'amount'     =>  '500',
                'is_deleted'     =>  '0',
            ],
            [
                'id'    =>  '4',
                'package_id'    =>  '0',
                'rule_key'     =>  'future_documentary',
                'rule_description'     =>  'Future Documentary',
                'amount'     =>  '30',
                'is_deleted'     =>  '0',
            ],
            [
                'id'    =>  '5',
                'package_id'    =>  '0',
                'rule_key'     =>  'prioritize_my_account',
                'rule_description'     =>  'Prioritize my Account',
                'amount'     =>  '100',
                'is_deleted'     =>  '0',
            ],
            [
                'id'    =>  '6',
                'package_id'    =>  '0',
                'rule_key'     =>  'map_sponsorship',
                'rule_description'     =>  'Map Sponsorship (pin your video to our feed)',
                'amount'     =>  '100',
                'is_deleted'     =>  '0',
            ]
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
