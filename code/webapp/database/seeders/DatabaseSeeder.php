<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTypesSeeder::class,
            SectionSeeder::class,
            RoleSeeder::class,
            SurveySeeder::class,
            MailSeeder::class,
            MailContentSeeder::class,
            UserSeeder::class,
            TreePartSeeder::class,
        ]);
    }
}
