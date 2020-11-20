<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Groupes;
use \App\Models\User;
use \App\Models\EC;
use \App\Models\Seance;

class SeanceTableSeeder extends Seeder
{
    /**
     * Peuplement de la table seances
     *
     * @return void
     */
    public function run()
    {
        Seance::truncate();
        
        $idGroupe = Groupes::pluck('idGroupe');
        $faker = \Faker\Factory::create();

        Seance::create([
            'debutSeance' => $faker->dateTimeBetween('now',"+6 months","UTC")->format('Y-m-d'),
            'finSeance' => $faker->dateTimeBetween('now',"+6 months","UTC")->format('Y-m-d'),
            'idGroupe' => $faker->randomElement($idGroupe)
        ]);
    }
}
