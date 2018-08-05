<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ContentAccessLevelSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(MetaDataTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(StatusTableSeeder::class);

        $this->call(UsersTableSeeder::class);
    }
}
