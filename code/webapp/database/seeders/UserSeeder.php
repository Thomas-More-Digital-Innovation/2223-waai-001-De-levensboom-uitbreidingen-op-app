<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_type_id' => 1,
            'firstname' => 'Admin',
            'surname' => 'Admin',
            'birthdate' => '1990-01-01',
            'email' => 'admin@dewaaiburgapp.eu',
            'password' => bcrypt('adminadmin'),
        ]);
    }
}
