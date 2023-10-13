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
            "tree_part" => "Grond",
        ]);
        DB::table("tree_parts")->insert([
            "tree_part" => "Wortels",
        ]);
        DB::table("tree_parts")->insert([
            "tree_part" => "Stam",
        ]);
        DB::table("tree_parts")->insert([
            "tree_part" => "Bladeren",
        ]);
        DB::table("tree_parts")->insert([
            "tree_part" => "Vogels",
        ]);
        DB::table("tree_parts")->insert([
            "tree_part" => "Appels",
        ]);
    }
}
