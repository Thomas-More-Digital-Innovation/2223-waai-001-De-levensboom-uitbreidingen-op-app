<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TreePartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("tree_parts")->insert([
            "name" => "Grond",
        ]);
        DB::table("tree_parts")->insert([
            "name" => "Wortels",
        ]);
        DB::table("tree_parts")->insert([
            "name" => "Stam",
        ]);
        DB::table("tree_parts")->insert([
            "name" => "Bladeren",
        ]);
        DB::table("tree_parts")->insert([
            "name" => "Vogels",
        ]);
        DB::table("tree_parts")->insert([
            "name" => "Appels",
        ]);
    }
}
