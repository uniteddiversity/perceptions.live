<?php

use Illuminate\Database\Seeder;

class MediaPackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('media_packages')->insert([
            [
                'id'            =>  '1',
                'name'    =>  'Free',
                'description'     =>  'Free for less than 3 minutes of final footage.',
                'min_video_minutes'     =>  '0',
                'max_video_minutes'     =>  '3',
                'charge_per_minute'     =>  '0',
                'is_deleted'     =>  '0',
            ],
            [
                'id'            =>  '2',
                'name'          =>  'Basic',
                'description'     =>  'Basic Package.',
                'min_video_minutes'     =>  '3',
                'max_video_minutes'     =>  '5',
                'charge_per_minute'     =>  '10',
                'is_deleted'     =>  '0',
            ],
            [
                'id'            =>  '3',
                'name'    =>  'Plus',
                'description'     =>  'Plus Package.',
                'min_video_minutes'     =>  '5',
                'max_video_minutes'     =>  '15',
                'charge_per_minute'     =>  '25',
                'is_deleted'     =>  '0',
            ]
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
