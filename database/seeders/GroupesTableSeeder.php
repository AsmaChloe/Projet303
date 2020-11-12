<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Groupes;

class GroupesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Groupes::truncate();

        Groupes::create([
            'nomGroupe' => "S3F",
            'typeGroupe' => "CM"
        ]);

        Groupes::create([
            'nomGroupe' => "S3F3",
            'typeGroupe' => "TD"
        ]);

        Groupes::create([
            'nomGroupe' => "S3F3A",
            'typeGroupe' => "TP"
        ]);
    }
}
