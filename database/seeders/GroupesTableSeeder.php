<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Groupes;

class GroupesTableSeeder extends Seeder
{
    /**
     * Peuplement de la table groupes
     *
     * @return void
     */
    public function run()
    {
        Groupes::truncate();

        //Informatique
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

        Groupes::create([
            'nomGroupe' => "S3F3B",
            'typeGroupe' => "TP"
        ]);

        //Mathematiques
        Groupes::create([
            'nomGroupe' => "B1F",
            'typeGroupe' => "CM"
        ]);

        Groupes::create([
            'nomGroupe' => "B1F1",
            'typeGroupe' => "TD"
        ]);

        Groupes::create([
            'nomGroupe' => "B1F1A",
            'typeGroupe' => "TP"
        ]);

        Groupes::create([
            'nomGroupe' => "B1F1B",
            'typeGroupe' => "TP"
        ]);
    }
}
