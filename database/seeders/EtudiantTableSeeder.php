<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class EtudiantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('etudiants')->truncate();$faker = \Faker\Factory::create();
        for($i = 0; $i < 90; $i++) {
            \App\Models\Etudiant::create([
                'NomEtudiant' => $faker->lastName,
                'PrenomEtudiant' => $faker->firstName,
                'DateNaissanceEtu' => $faker->dateTimeBetween('-30 years', '-17 years', 'UTC')
                ->format('Y-m-d'),
            ]);
        }

    }
}
