<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("infos")->insert([
            "title" => "Account aangemaakt voor Waaiburg Web applicatie",
            "section_id" => "4",
        ]);
        DB::table("infos")->insert([
            "title" => "Account aangemaakt voor APP",
            "section_id" => "4",
        ]);
        DB::table("infos")->insert([
            "title" => "Wachtwoord vergeten voor WebApp",
            "section_id" => "4",
        ]);
        DB::table("infos")->insert([
            "title" => "Wachtwoord vergeten voor APP",
            "section_id" => "4",
        ]);
        DB::table("infos")->insert([
            "title" => "Tevredenheidsmeting beschikbaar",
            "section_id" => "4",
        ]);
    }
}
