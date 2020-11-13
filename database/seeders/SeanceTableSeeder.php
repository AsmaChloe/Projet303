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
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //HEURE PAS BONNE, FAIRE HEURE DE FIN DE SEANCE APRES DEBUT SEANCE
        $idUser = User::where("role",2)->get()->pluck('id');
        $idEC = EC::pluck('idEC');
        $idGroupe = Groupes::pluck('idGroupe');
        $faker = \Faker\Factory::create();
        Seance::create([
            'debutSeance' => $faker->dateTimeBetween('now',"+6 months","UTC")->format('Y-m-d'),
            'finSeance' => $faker->dateTimeBetween('now',"+6 months","UTC")->format('Y-m-d'),
            'idUser' => $faker->randomElement($idUser),
            'idGroupe' => $faker->randomElement($idGroupe),
            'idEC' => $faker->randomElement($idEC)
        ]);
    }
}
