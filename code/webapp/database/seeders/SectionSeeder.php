<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("sections")->insert(["name" => "Volwassenen"]);
        DB::table("sections")->insert(["name" => "Jongeren"]);
        DB::table("sections")->insert(["name" => "Nieuwtjes"]);
        DB::table("sections")->insert(["name" => "Mails"]);
        DB::table("sections")->insert(["name" => "Tevredenheidsmeting"]);
    }
}
